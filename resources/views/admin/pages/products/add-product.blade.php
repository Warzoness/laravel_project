@extends('admin.master')
@section('main-content')
    <div class="main-panel">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add new product</h4>
                    <form class="forms-sample" method="POST" action="{{ route('products.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            {{-- name input --}}
                            <div class="form-group col-lg-6 @error('name') has-danger @enderror">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" class="form-control text-white " id="exampleInputName1"
                                    placeholder="Name" id="name" name="name">
                                @error('name')
                                    <p class="text-danger ">{{ $message }}</p>
                                @enderror
                            </div>

                            <br>
                            {{-- choose the category  --}}
                            <div class="form-group col-lg-6">
                                <label for="exampleInputName1">Category</label>

                                <select class="js-example-basic-single w-100" name="category_id">
                                    @foreach ($categories as $item)
                                        <option class="input-group-lg " value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- price --}}
                            <div class="form-group col-lg-6 @error('price') has-danger @enderror">
                                <label for="exampleInputEmail3">Price</label>
                                <input type="number" class="form-control text-white" name="price" id="exampleInputEmail3"
                                    placeholder="Price">
                                @error('price')
                                    <p class="text-danger ">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- sale price --}}
                            <div class="form-group col-lg-6 @error('sale_price') has-danger @enderror">
                                <label for="exampleInputEmail3">Sale Price</label>
                                <input type="number" class="form-control text-white" id="exampleInputEmail3"
                                    placeholder="Sale Price" name="sale_price">
                                @error('sale_price')
                                    <p class="text-danger ">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                        {{-- main image  --}}
                        <div class="form-group m-2" @error('photo') has-danger @enderror>
                            <label>Main Image</label>
                            <input type="file" name="photo" class="file-upload-default"
                                onchange="showImg(this,'main-image-preview')">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                            @error('photo')
                                <p class="text-danger ">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- main img preview  --}}
                        <label for="image-preview" class="text-success">Main Image Preview</label>
                        <div class="row">
                            <div class="col-lg-3">
                                <img src="" id="main-image-preview" alt="" class="w-100">
                            </div>
                        </div>
                        {{-- sub image  --}}
                        <div class="form-group m-2 @error('photos') has-danger @enderror">
                            <label> Sub Image</label>
                            <input type="file" name="photos[]" class="file-upload-default" onchange="preview(this)"
                                multiple>
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                            @error('photos')
                                <p class="text-danger ">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- sub image preview  --}}
                        <label for="image-preview" class="text-success">Sub Image Preview</label>
                        <div class="row" id="sub-image-preview">

                        </div>

                        {{-- description  --}}
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" id="editor1" rows="10" cols="80">
                        </textarea>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary mr-2">Add</button>
                        <button class="btn btn-dark">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('myCustomJs')
    <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('editor1');
        title = document.getElementById("title").value;

        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();

        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, " - ");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”
    // document.getElementById('slug').value = slug;


    function showImg(input, target) {
        let file = input.files[0];
        let reader = new FileReader();

        reader.readAsDataURL(file);
        reader.onload = function() {
            let img = document.getElementById(target);
            // can also use "this.result"
            img.src = reader.result;
        }
    }

    function preview(elem, output = '') {
        const i = 0;
        Array.from(elem.files).map((file) => {
            const blobUrl = window.URL.createObjectURL(file)
            output +=
                `<div class="col-lg-3" id="img-add">
                    <p class="close-img-button text-center close-img-btn">X</p>
                    <div class="card text-left bg-white border-danger "> 
                        <img class="card-img-bottom" src=${blobUrl} alt="">
                    </div>
                </div>`
            })
            document.getElementById('sub-image-preview').innerHTML += output
        }
    </script>
@endsection
