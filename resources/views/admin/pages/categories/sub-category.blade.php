@extends('admin.master')
@section('title', '| Category')
@section('search-bar')
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-menu"></span>
    </button>
    <ul class="navbar-nav w-100">
        <li class="nav-item w-100">
            <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                <input type="text" class="form-control" placeholder="Search category">
            </form>
        </li>
    </ul>
@endsection
@section('main-content')
    <div class="main-panel">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Category List</h3>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-white sortable">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th class="sortTh"> Category Name</th>
                                    <th class="sortTh"> Parent Category </th>
                                    <th class="sortTh"> Status </th>
                                    <th class="sortTh"> Time Created </th>
                                    <th class="sortTh"> Time Updated</th>
                                    <th></th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subCategory as $item)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ $item->name }} </td>
                                        <td>
                                            {!! $item->parent->name ?? '<strong class="text-danger ">M</strong>' !!}
                                        </td>
                                        <td> {!! $item->status
                                            ? '<label class="badge badge-success">Available </label>'
                                            : '<label class="badge badge-danger">Unavailable </label>' !!} </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('categories.show', $item) }}"
                                                class="btn btn-success btn-xs btn-sm" data-toggle="tool-tip"
                                                title="Detail"><i class="fa-solid fa-pencil"></i>
                                                Detail</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('categories.edit', $item) }}"
                                                class="btn btn-warning btn-xs btn-sm" data-toggle="tool-tip"
                                                title="Edit"><i class="fa-solid fa-pencil"></i>
                                                Edit</a>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('categories.destroy', $item->id) }}">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit"
                                                    class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-sm"
                                                    data-toggle="tooltip" title='Delete'> <i
                                                        class="fa-solid fa-trash-can"></i>Delete</button>
                                            </form>

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center m-5 ">
                        {{ $subCategory->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/sorttable.js') }}"></script>

@endsection
