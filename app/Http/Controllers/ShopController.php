<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ShopController extends Controller
{
    public function __construct(
        private readonly Request $request
    ) {
    }

    public function update(): RedirectResponse
    {
        $shop = Shop::query()
            ->join('users', 'shops.user_id', '=', 'users.id')
            ->where('role', 2)
            ->first('shops.id');

        $certificateImage = $this->request->file('certificate_image');
        $bannerImage = $this->request->file('banner_image');

        if (!$shop) {
            Shop::create([
                'user_id' => Auth::id(),
                'name' => $this->request->shop_name,
                'phone_number' => $this->request->phone_number,
                'description' => $this->uploadImage($certificateImage),
                'banner_image' => $this->uploadImage($bannerImage),
                'certificate_image' => $certificateImage,
                'address' => $this->request->address,
                'coordinate' => $this->request->coordinate,
            ]);
        } else {
            $shop->name = $this->request->shop_name;
            $shop->phone_number = $this->request->phone_number;
            $shop->description = $this->request->description;
            $shop->banner_image = $this->uploadImage($bannerImage);
            $shop->certificate_image = $this->uploadImage($certificateImage);
            $shop->address = $this->request->address;
            $shop->coordinate = $this->request->coordinate;
            $shop->save();
        }
        return Redirect::route('profile.edit');
    }

    private function uploadImage(?UploadedFile $file): string
    {
        if (!$file) {
            return '';
        }
        $filename = date('YmdHi') . $file->getClientOriginalName();
        $file->move(public_path('/upload/image'), $filename);
        return $filename;
    }
}