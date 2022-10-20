@extends('layout')

@section('content')
<div id="upload">
    <div class="row">
        <x-validation-errors></x-validation-errors>
        <!-- upload -->
        <div class="col-md-8">
            <h1 class="page-title"><span>آپلود</span> ویدیو</h1>
            <form action="{{ route('videos.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label>@lang('videos.name')</label>
                        <input type="text" name="name" class="form-control" value="{{old("name")}}" placeholder="@lang('videos.name')">
                    </div>
                    <div class="col-md-6">
                        <label>@lang('videos.length')</label>
                        <input type="text" name="length" class="form-control" value="{{old("length")}}" placeholder="@lang('videos.length')">
                    </div>
                    <div class="col-md-6">
                        <label>نام یکتا</label>
                        <input type="text" name="slug" class="form-control" value="{{old("slug")}}" placeholder="نام یکتا">
                    </div>
                    <div class="col-md-6">
                        <label>آدرس ویدیو</label>
                        <input type="text" name="url" class="form-control" value="{{old("url")}}" placeholder="آدرس ویدیو">
                    </div>
                    <div class="col-md-6">
                        <label>تصویر بندانگشتی</label>
                        <input type="text" name="thumbnail" class="form-control" value="{{old("thumbnail")}}" placeholder="تصویر بندانگشتی">
                    </div>
                    <div class="col-md-6">
                        <label>دسته بندی</label>
                        <select name="category_id" id="category" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label>توضیحات</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="توضیح">{{old("name")}}</textarea>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" id="contact_submit" class="btn btn-dm">ذخیره</button>
                    </div>
                </div>
            </form>
        </div><!-- // col-md-8 -->

        <div class="col-md-4">
            <a href="#"><img src="{{ asset('img/upload-adv.png') }}" alt=""></a>
        </div><!-- // col-md-8 -->
        <!-- // upload -->
    </div><!-- // row -->
</div><!-- // upload -->
@endsection
