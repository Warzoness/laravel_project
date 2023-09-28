@extends('admin.master')
@section('title', '| Category')

@section('main-content')

    <div class="main-panel">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Of Products</h4>
                    </p>
                    <div class="">
                        <table class="table text-white ">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Category Name</th>
                                    <th> Category </th>
                                    <th> Status </th>
                                    <th> Image </th>
                                    <th> Time Created </th>
                                    <th> Time Updated</th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $item)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ $item->name }} </td>
                                        <td>
                                            {{ $item->category->name }}
                                        </td>

                                        <td> {!! $item->status
                                            ? '<label class="badge badge-success">Available </label>'
                                            : '<label class="badge badge-danger">Unavailable </label>' !!} </td>
                                        <td>
                                            <img src="{{ asset('storage/uploads/images') . '/' . $item->image }}"
                                                alt="" width="150px">
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('products.edit', $item) }}"
                                                class="btn btn-warning btn-xs btn-sm" data-toggle="tool-tip"
                                                title="Edit"><i class="fa-solid fa-pencil"></i>
                                                Edit</a>
                                        </td>

                                        <td>
                                            <form method="POST" action="{{ route('products.destroy', $item->id) }}">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit"
                                                    class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-sm"
                                                    data-toggle="tooltip" title='Delete'>Delete</button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center m-5 ">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
