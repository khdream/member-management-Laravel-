@extends('layouts.app')

@section('content')
<div class="container-full mx-5">
    <div class="row justify-content-center">
        <div class="col-12 mb-3">
            <div class="row mb-3 border-bottom">
                <div class="col-6">
                    <div class="float-end"><h3>発送依頼</h3></div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                </div>
                <div class="col-6">
                    <div class="mb-3 row">
                        <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">会員</label>
                        <div class="col-sm-8">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>client-1</option>
                                <option value="1">client-2</option>
                                <option value="2">client-3</option>
                                <option value="3">client-4</option>
                                <option value="3">client-5</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">発送日</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="date">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4 pe-3">
                <div class="col-3"></div>
                <div class="col-6 d-flex justify-content-between">
                    <div class="w-75 row">
                        <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">CSVで一括登録</label>
                        <div class="col-sm-8">
                            <button type="button" class="btn btn-primary px-5">CSVアップロード</button>
                        </div>
                    </div>
                    <div class="w-25 row">
                        <button type="button" class="btn btn-primary w-100">依頼用CSVダウンロード</button>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-hover text-center">
            <thead class="table-dark align-middle">
                <tr>
                    <th class="py-3" rowspan="3" scope="col">管理ID</th>
                    <th class="py-3" rowspan="3" scope="col">本のタイトル</th>
                    <th class="py-3" colspan="4" scope="col">配送先ID /ラベル</th>
                    <th class="py-3" rowspan="3" scope="col">出荷計</th>
                    <th class="py-3" rowspan="3" scope="col">現在の在庫</th>
                    <th class="py-3" rowspan="3" scope="col">出荷後在庫</th>
                </tr>
                <tr>
                    <th>11</th>
                    <th>13</th>
                    <th>14</th>
                    <th>15</th>
                </tr>
                <tr>
                    <th>北千里</th>
                    <th>北千里</th>
                    <th>北千里</th>
                    <th>北千里</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th class="align-middle" scope="row">E-111</th>
                    <td class="align-middle">aasdasd</td>
                    <td class="align-middle">11</td>
                    <td class="align-middle">11</td>
                    <td class="align-middle">11</td>
                    <td class="align-middle">11</td>
                    <td class="align-middle">222</td>
                    <td class="align-middle">555</td>
                    <td class="align-middle">333</td>
                </tr>
                <tr>
                    <th class="align-middle" scope="row">E-111</th>
                    <td class="align-middle">aasdasd</td>
                    <td class="align-middle">11</td>
                    <td class="align-middle">11</td>
                    <td class="align-middle">11</td>
                    <td class="align-middle">11</td>
                    <td class="align-middle">222</td>
                    <td class="align-middle">555</td>
                    <td class="align-middle">333</td>
                </tr>
                <tr>
                    <th class="align-middle" scope="row">E-111</th>
                    <td class="align-middle">aasdasd</td>
                    <td class="align-middle">11</td>
                    <td class="align-middle">11</td>
                    <td class="align-middle">11</td>
                    <td class="align-middle">11</td>
                    <td class="align-middle">222</td>
                    <td class="align-middle">555</td>
                    <td class="align-middle">333</td>
                </tr>
            </tbody>
        </table>
        <div class="row mt-3">
            <div class="col-12">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4"><button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#confirmInputedData">依頼する</button></div>
                    <div class="col-4"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
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
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmInputedData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">本当に提出してもよろしいですか？</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    内容を確認してください。
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">取り消す</button>
                    <button type="button" class="btn btn-primary text-white">確認</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
