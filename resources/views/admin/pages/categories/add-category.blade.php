@extends('admin.master')
@section('title', '| Add New Category')
@section('main-content')
    <div class="main-panel">
        <div class="col-12 grid-margin stretch-card">
            <form class="card" method="POST" enctype="multipart/form-data" action="{{ route('categories.store') }}">
                @csrf
                <div class="card-body">
                    <h4 class="card-title">TABLES | Add new category</h4>
                    <form class="forms-sample">
                        <div class="form-group @error('name') has-danger @enderror">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" class="form-control text-white" id="exampleInputName1" name="name">
                            @error('name')
                                <small class="text-danger ">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group @error('status') has-danger @enderror">
                            <label for="exampleInputEmail3">Status</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id=""
                                        value="1" checked>Show
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id=""
                                        value="0">Hide
                                </label>
                            </div>
                        </div>
                        @error('status')
                            <small class="text-danger ">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <label for="">This is Parent Category ?</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="checkParent" id=""
                                        value="checkedValue" checked onclick="hideParentCate()">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="checkParent" id=""
                                        value="checkedValue" onclick="showParentCate()">
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 grid-margin stretch-card" style="display: none" id="parentCate">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Choose the parent Category</h4>
                                    <div class="form-group">
                                        <select class="js-example-basic-single" name="parent_id" id="parent_id"
                                            style="width:100%">
                                            <option value="" selected>Choose the category</option>
                                            @foreach ($categories as $item)
                                                <option class="input-group-lg " value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="editor1" id="editor1" rows="10" cols="80">
                        </textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-dark">Cancel</button>
                    </form>
                </div>
            </form>
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
        document.getElementById('slug').value = slug;
    </script>
@endsection
