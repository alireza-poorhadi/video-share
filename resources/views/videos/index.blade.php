@extends('layout')

@section('content')

{{-- ----------------------------- --}}
{{-- Filter --}}
    <form class="mt-5" action="">
        <div class="row">
            <div class="form-group col-md-3">
                <label for="sortBy">ترتیب بر اساس</label>
                <select name="sortBy" id="sortBy" class="form-control">
                    <option value="">انتخاب کنید...</option>
                    <option value="created_at" {{ request()->query('sortBy') == 'created_at' ? 'selected' : '' }}>جدیدترین</option>
                    <option value="like" {{ request()->query('sortBy') == 'like' ? 'selected' : '' }}>محبوب‌ترین</option>
                    <option value="length" {{ request()->query('sortBy') == 'length' ? 'selected' : '' }}>مدت زمان ویدیو</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="length">مدت زمان‌</label>
                <select name="length" id="length" class="form-control">
                    <option value="" {{ request()->query('length') == null ? 'selected' : '' }}>همه</option>
                    <option value="1" {{ request()->query('length') == 1 ? 'selected' : '' }}>کمتر از یک دقیقه</option>
                    <option value="2" {{ request()->query('length') == 2 ? 'selected' : '' }}>1 تا 5 دقیقه</option>
                    <option value="3" {{ request()->query('length') == 3 ? 'selected' : '' }}>بیشتر از 5 دقیقه</option>
                </select>
            </div>
            <input type="hidden" name="q" value="{{ request()->query('q') }}">
            <div class="form-group col-md-3" style="margin-top: 29px;">
                <button type="submit" class="btn btn-primary">فیلتر</button>
            </div>
        </div>
    </form>
{{-- ---------------------------------- --}}

    <h1 class="new-video-title"><i class="fa fa-bolt"></i>{{ $title }}</h1>
    <div class="row">

        <!-- video-item -->
        @foreach ($videos as $video)
            <x-video-box :video="$video" />
        @endforeach

    </div>

    <div class="text-center" style="direction: ltr;">
        {{ $videos->links() }}
    </div>
@endsection
