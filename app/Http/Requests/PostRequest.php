<?php

namespace App\Http\Requests;

use App\Rules\textMaxWidth;
use Illuminate\Foundation\Http\FormRequest;
use Image; //intervention/imageライブラリの読み込み

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'description' => ['nullable','string',new textMaxWidth(160)],
            'image'=>'required|file|image|mimes:jpg,png,gif,jpeg',
            'theme_id'=>'required|numeric',
        ];
    }
    public function attributes()
    {
        return [
            'description' => '作品の説明',
            'image'=>'画像',
            'theme_id'=>'テーマ',
        ];
    }
    public function imageProcessing(){
        $this->session()->regenerateToken();
        // ↑二重送信防止用

        $thistime = date("YmdHis");
        // $image->orientate();をしとかないと、スマホでアップされた画像が勝手に横向きになったりするので要注意
        $save_image_path = "storage/uploads/illust_image/" . $this->user()->id . "illust" . $thistime . ".jpg";
        Image::make($this->file('image'))->orientate()->resize(1500, null, function ($constraint) {
            // 縦横比を保持したままにする
            $constraint->aspectRatio();
            // 小さい画像は大きくしない
            $constraint->upsize();
        })->save($save_image_path, 70);

        // サムネイル用
        $width = Image::make($this->file('image'))->orientate()->width();
        $height = Image::make($this->file('image'))->orientate()->height();

        if ($width >= $height) {
            $cropX = round(($width - $height) / 2);
            $cropY = 0;
            $keySize = $height;
        } else {
            $cropX = 0;
            $cropY = round(($height - $width) / 2);
            $keySize = $width;
        }
        $save_thumb_path = "storage/uploads/illust_thumb/" . $this->user()->id . "thumb" . $thistime . ".jpg";

        Image::make($this->file('image'))->orientate()->crop($keySize, $keySize, $cropX, $cropY)->resize(300, 300)->save($save_thumb_path, 70);
        return [$save_image_path,$save_thumb_path];
    }
}
