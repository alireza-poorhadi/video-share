@extends('layout')

@section('content')
    <div id="upload">
        <div class="row">
            <x-validation-errors></x-validation-errors>
            <!-- upload -->
            <div class="col-md-8">
                <h1 class="page-title"><span>ویرایش</span> ویدیو</h1>
                <form action="{{ route('videos.update', $video->slug) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label>@lang('videos.name')</label>
                            <input type="text" name="name" class="form-control" value="{{ $video->name }}" placeholder="@lang('videos.name')">
                        </div>
                        <div class="col-md-6">
                            <label>@lang('videos.length')</label>
                            <input type="text" name="length" class="form-control" value="{{ $video->length }}" placeholder="@lang('videos.length')">
                        </div>
                        <div class="col-md-6">
                            <label>@lang('videos.slug')</label>
                            <input type="text" name="slug" class="form-control" value="{{ $video->slug }}" placeholder="@lang('videos.slug')">
                        </div>
                        <div class="col-md-6">
                            <label>@lang('videos.url')</label>
                            <input type="text" name="url" class="form-control" value="{{ $video->url }}" placeholder="@lang('videos.url')">
                        </div>
                        <div class="col-md-6">
                            <label>@lang('videos.thumbnail')</label>
                            <input type="text" name="thumbnail" class="form-control" value="{{ $video->thumbnail }}" placeholder="@lang('videos.thumbnail')">
                        </div>
                        <div class="col-md-6">
                            <label>@lang('videos.category')</label>
                            <select class="form-control" name="category_id" id="category">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $video->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label>@lang('videos.description')</label>
                            <textarea name="description" class="form-control" rows="4" placeholder="@lang('videos.description')">{{ $video->description }}</textarea>
                        </div>
                        <div class="col-md-2">
                            <input type="submit" id="contact_submit" class="btn btn-dm" value="@lang('videos.save')">
                        </div>
                    </div>
                </form>
            </div><!-- // col-md-8 -->

            <div class="col-md-4">
                <a href="#"><img src="{{ asset('img/upload-adv.png') }}" alt=""></a>
            </div><!-- // col-md-8 -->
            <!-- // upload -->
@endsection