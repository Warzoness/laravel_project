@extends('admin.master')
@section('title', '| Category')
@section('main-content')
    <div class="main-panel">

        <div class="col-lg-12 stretch-card">
            <div class="card">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">

                        <button type="button" class="close" data-dismiss="alert">×</button>

                        <strong>{{ $message }}</strong>

                    </div>
                @endif
                <div class="card-body">
                    <h4 class="card-title">Bordered table</h4>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped text-white ">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Category Name</th>
                                    <th> Parent Category </th>
                                    <th> Status </th>
                                    <th> Date Created </th>
                                    <th> Date Updated</th>
                                    <th> </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $item)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ $item->name }} </td>
                                        <td>
                                            @if ($item->parent_id == $item->id)
                                                {{ $item->name }}
                                            @else
                                                {{ null }}
                                            @endif
                                        </td>
                                        <td> {{ $item->status ? 'Show' : 'Hide' }} </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('trashCate.restore', $item->id) }}"
                                                class="btn btn-outline-success "><i class="fa-solid fa-arrows-spin"></i>
                                                Restore</a>
                                        </td>

                                        <td>
                                            <form method="POST" action="{{ route('trashCate.forceDelete', $item->id) }}">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit"
                                                    class="btn btn-xs btn-danger btn-flat show-alert-delete-box-1 btn-sm"
                                                    data-toggle="tooltip" title='Delete'>Delete</button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
