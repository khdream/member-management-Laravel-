@extends('layouts.app')

@section('content')
<div class="container-full mx-5">
    <div class="row justify-content-center">
        <div class="col-12 mb-3">
            <div class="row mb-3 border-bottom">
                <div class="col-5"></div>
                <div class="col-3">
                    <div class=""><h3 class="tab-title">受注管理</h3></div>
                </div>
                <div class="col-4"></div>
            </div>
            <div class="row">
                <div class="col-lg-9 col-md-12 order-manage-font">
                    <div class="mb-3 row">
                        <label for="exampleFormControlInput1" class="col-xl-2 col-lg-3 col-md-4 col-form-label">絞り込み検索</label>
                        <div class="col-xl-6 col-lg-5 col-md-6">
                            <input class="form-control" id="exampleFormControlInput1" type="text" placeholder="山田太郎">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 table-responsive">
            <table class="table table-hover text-center table-responsive-width">
                <thead class="table-dark align-middle">
                    <tr>
                        <th>管理ID</th>
                        <th>クライアント名</th>
                        <th>ステータス</th>
                        <th>詳細はこちら</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="align-middle" scope="row">E-111</th>
                        <td class="align-middle">aasdasd</td>
                        <td class="align-middle">11</td>
                        <td class="align-middle"><a href="/orders">詳細はこちら</a></td>
                    </tr>
                    <tr>
                        <th class="align-middle" scope="row">E-111</th>
                        <td class="align-middle">aasdasd</td>
                        <td class="align-middle">11</td>
                        <td class="align-middle"><a href="/orders">詳細はこちら</a></td>
                    </tr>
                    <tr>
                        <th class="align-middle" scope="row">E-111</th>
                        <td class="align-middle">aasdasd</td>
                        <td class="align-middle">11</td>
                        <td class="align-middle"><a href="/orders">詳細はこちら</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
