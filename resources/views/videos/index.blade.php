@extends('layout')

@section('content')

    <form action="#" class="mt-5 main-page-filter" method="get" style="padding: 35px 0px 0px;">
        <div class="row">
            <div class="form-group col-md-3">
                <label for="inputCity">ترتیب بر اساس</label>
                <select class="form-control" name="sortBy">
                    <option {{ request()->query('sortBy') == 'created_at' ? 'selected' : '' }} value="created_at">جدیدترین</option>
                    <option {{ request()->query('sortBy') == 'like' ? 'selected' : '' }} value="like">محبوب ترین</option>
                    <option {{ request()->query('sortBy') == 'length' ? 'selected' : '' }} value="length">مدت زمان ویدیو</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="inputState">مدت زمان</label>
                <select class="form-control" name="length">
                    <option {{ request()->query('length') == null ? 'selected' : '' }} value="">همه</option>
                    <option {{ request()->query('length') == 1 ? 'selected' : '' }} value="1">کمتر از یک دقیقه</option>
                    <option {{ request()->query('length') == 2 ? 'selected' : '' }} value="2">یک تا پنج دقیقه</option>
                    <option {{ request()->query('length') == 3 ? 'selected' : '' }} value="3">بیشتر از پنج دقیقه</option>
                </select>
            </div>
            <input type="hidden" name="q" value="{{  request()->query('q') }}">
            <div class="form-group col-md-3" style="margin-top: 29px">
                <button type="submit" class="btn btn-primary">فیلتر</button>
            </div>
        </div>
    </form>

    <h1 class="new-video-title"><i class="fa fa-bolt"></i> {{ $title }} </h1>
    <div class="row">
        @foreach($videos as $video)
            <x-video-box :video="$video"></x-video-box>
        @endforeach
    </div>

    <div class="text-center">
        {{ $videos->links() }}
    </div>


@endsection
