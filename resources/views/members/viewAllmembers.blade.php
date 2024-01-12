@extends('layouts.app')

@section('content')
<div class="container-full mx-5">
    <div class="row justify-content-center">
        <div class="col-12 mb-3">
            <div class="row">
                <div class="col-6">
                    <div class="float-end"><h3 class="tab-title">会員一覧</h3></div>
                </div>
                <div class="col-6">
                    <div class="float-end"><button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">新規登録</button></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row table-responsive">
        <table class="table table-hover text-center table-responsive-width">
            <thead class="table-dark">
                <tr>
                    <th class="py-3" scope="col">#</th>
                    <th class="py-3" scope="col">法人名</th>
                    <th class="py-3" scope="col">担当者氏名</th>
                    <th class="py-3" scope="col">担当者ふりがな</th>
                    <th class="py-3" scope="col">メールアドレス</th>
                    <th class="py-3" scope="col">電話番号</th>
                    <th class="py-3" scope="col">郵便番号</th>
                    <th class="py-3" scope="col">住所</th>
                    <th class="py-3" scope="col">番地</th>
                    <th class="py-3" scope="col">ビル名</th>
                    <th class="py-3" scope="col">編集</th>
                    <th class="py-3" scope="col">消去</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th class="align-middle" scope="row">1</th>
                    <td class="align-middle">a</td>
                    <td class="align-middle">s</td>
                    <td class="align-middle">s</td>
                    <td class="align-middle">personal.codemaker@gmail.com</td>
                    <td class="align-middle">123</td>
                    <td class="align-middle">1111-1111111</td>
                    <td class="align-middle">13</td>
                    <td class="align-middle">e</td>
                    <td class="align-middle">w</td>
                    <td class="align-middle"><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">編集</button></td>
                    <td class="align-middle"><button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteMemberModal">消去</button></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>a</td>
                    <td>s</td>
                    <td>s</td>
                    <td>personal.codemaker@gmail.com</td>
                    <td>123</td>
                    <td>1111-1111111</td>
                    <td>13</td>
                    <td>e</td>
                    <td>w</td>
                    <td><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">編集</button></td>
                    <td><button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteMemberModal">消去</button></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="/">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">会員情報</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">法人名</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" placeholder="法人名" aria-label="default input example">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">担当者氏名</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" placeholder="担当者氏名" aria-label="default input example">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">担当者ふりがな</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" placeholder="担当者ふりがな" aria-label="default input example">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">メールアドレス</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">パスワード</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputPassword">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">電話番号</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" placeholder="1234567890" aria-label="default input example">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">郵便番号</label>
                            <div class="col-sm-8 d-flex justify-content-between">
                                <div class="w-25"><input class="form-control" readonly type="text" placeholder="000"></div>
                                -
                                <div class="w-50"><input class="form-control" type="text" placeholder="0000"></div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">住所</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" placeholder="shikoku" aria-label="default input example">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">番地</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" placeholder="112" aria-label="default input example">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">ビル名</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" placeholder="123ビル名" aria-label="default input example">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取り消す</button>
                        <button type="button" class="btn btn-primary">確認</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteMemberModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="staticBackdropLabel">消す</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    これは削除してもよろしいでしょうか？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">取り消す</button>
                    <button type="button" class="btn btn-danger text-white">確認</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
