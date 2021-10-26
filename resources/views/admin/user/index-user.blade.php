@extends('layoutmaster.master_admin')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <button class="btn btn-success mt-4">ADD</button>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="shadow card mt-2">
                        <div class="card-header bg-primary">
                            <h3 class="card-title">Danh sách permission</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <div class="table-responsive-sm">
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 1%">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Birthdays</th>
                                            <th scope="col">avatar</th>
                                            <th scope="col" style="width: 12%">action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-user">
                                        @include('admin.user.partials_users.index-tablelist-user')
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @include('admin.user.partials_users.view-bottom-quantity')
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
