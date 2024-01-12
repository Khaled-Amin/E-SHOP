@extends('admin.layout.admin_master')

@section('title')
    الاعدادات
@endsection

@section('content')
    @include('admin.layout.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
        <!-- Navbar -->
        @include('admin.layout.navbar')
        <!-- End Navbar -->


        {{-- الاعدادات العامة --}}

        <form method="POST" action="{{ route('admin.setSittings') }}" class=" m-5  shadow " enctype="multipart/form-data">
            @csrf

            {{-- @if (!empty(session('msg')))
                <div class="row backgroundW p-4  ">
                    <div class="alert" style="background-color: #42424a ">
                        <ul>
                            <li style="color:white" class="">{{ session('msg') }}</li>
                        </ul>
                    </div>
                </div>
            @endif --}}
            <div class="container">
                @if ($message = Session::get('msg'))
                    <div class="alert alert-white" role="alert">
                        {{ $message }}
                    </div>
                @endif
            </div>
            <div class="row backgroundW p-4  ">
                @if ($errors->any())
                    <div class="alert" style="background-color: #42424a ">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li style="color:white" class=>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="col-12 mb-3">
                    <label for="inputFirstNmae" class="form-labell">أسم الموقع</label>
                    <input type="text" class="@error('nameWebsite') is-invalid @enderror form-controll "
                        name="nameWebsite" id="inputFirstNmae"
                        value="@isset($getShowSettings) {{ $getShowSettings->nameWebsite }} @endisset" required>
                </div>
                <div class="col-12 mb-3">
                    <label for="inputLastNmae" class="form-labell  ">رابط الموقع</label>
                    <input type="text" class="form-controll" name="linkWebsite" id="inputLastNmae"
                        value="@isset($getShowSettings) {{ $getShowSettings->linkWebsite }} @endisset">
                </div>
                {{-- <div class="col-12 mb-3">
                    <label for="inputLastNmae" class="form-labell  ">عدد الزيارات الموقع</label>
                    <input type="numeric" class="form-controll" name="count_University" id="inputLastNmae"
                        value="@isset($getShowSettings) {{ $getShowSettings->count_University }} @endisset">
                </div> --}}
                <div class="col-md-6 mb-3 ">
                    <label for="inputlink1" class="form-labell  ">رابط فيسبوك</label>
                    <input type="text" class="form-controll " name="socialMidiaFacebook" id="inputlink1"
                        value="@isset($getShowSettings) {{ $getShowSettings->socialMidiaFacebook }} @endisset">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="inputlink2" class="form-labell ">رابط تلغرام</label>
                    <input type="text" class="form-controll" name="socialMidiaTelegram" id="inputlink2"
                        value="@isset($getShowSettings) {{ $getShowSettings->socialMidiaTelegram }} @endisset">
                </div>
                <div class="col-12 mb-3">
                    <label for="inputlink3" class="form-labell ">رابط انستغرام</label>
                    <input type="text" class="form-controll" name="socialMidiaInstagram" id="inputlink3"
                        value="@isset($getShowSettings) {{ $getShowSettings->socialMidiaInstagram }} @endisset">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="inputlink4" class="form-labell ">رابط يوتيوب</label>
                    <input type="text" class="form-controll" name="socialMidiaYoutube" id="inputlink4"
                        value="@isset($getShowSettings) {{ $getShowSettings->socialMidiaYoutube }} @endisset">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="inputLinkden" class="form-labell ">Linkedin رابط </label>
                    <input type="text" id="inputLinkden" class="form-controll"
                        value="@isset($getShowSettings) {{ $getShowSettings->socialMidiaFacebook }} @endisset">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="Description" class="form-labell ">نبذة عن الموقع </label>
                    <textarea id="Description" name="Description" class="ckeditor form-controll resizeForTextarea">@isset($getShowSettings){{ $getShowSettings->Description }}@endisset</textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="Description" class="form-labell ">الكلمات المفتاحية ( يجب الفصل بينها بفاصلة)</label>
                    <textarea id="Description" name="Keywords" class="form-controll resizeForTextarea">@isset($getShowSettings) {{ $getShowSettings->Keywords }} @endisset</textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="Description" class="form-labell">اضافة صورة favicon</label>
                    <input type="file" name="favicon" id="inputLinkden" class="form-controll">
                    @isset($getShowSettings)
                        <img src="{{asset('uploading/' . $getShowSettings->favicon)}}" alt="">
                    @endisset
                </div>
                <div class="col-md-12 mb-3">
                    <label for="Description" class="form-labell ">اضافة صورة meta_image</label>
                    <input type="file" name="meta_image" id="inputLinkden" class="form-controll">
                    @isset($getShowSettings)
                        <img src="{{asset('uploading/' . $getShowSettings->meta_image)}}" alt="">
                    @endisset
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-dark" style="background-color: #42424a">حفظ</button>
                </div>
        </form>
        </div>

        </div>


        {{-- نهاية الاعدادات العامة --}}

        {{-- Footer --}}

        </div>
    </main>




@endsection
