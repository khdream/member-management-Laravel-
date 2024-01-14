@extends('layouts.app')

@section('content')
<div class="container-full mx-5">
    <div class="row justify-content-center">
        <div class="col-12 mb-1">
            <div class="row">
                <div class="col-12 border-bottom">
                    <div class="row">
                        <div class="col-5"></div>
                        <div class="col-3 float-start"><h3 class="tab-title">会員情報</h3></div>
                        <div class="col-4"></div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="col-10">
                            <div class="mb-3 row">
                                <div class="col-lg-4">
                                    <div class="row">
                                        <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">絞り込み</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" required name="company_name" type="text" placeholder="法人名" aria-label="default input example">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="float-end">
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">新規登録</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row table-responsive">
        <table class="table table-hover text-center table-responsive-width">
            <thead class="table-dark">
                <tr>
                    <th class="py-3" scope="col">#</th>
                    <th class="py-3" scope="col">クライアントID</th>
                    <th class="py-3" scope="col">クライアント名（法人名）</th>
                    <th class="py-3" scope="col">担当者名</th>
                    <th class="py-3" scope="col">連絡先（メールアドレス）</th>
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
                    <td class="align-middle">
                        <div>
                            <p class="m-0 p-0">personal.codemaker@gmail.com</p>
                            <p class="m-0 p-0">11-1111-1111</p>
                        </div>
                    </td>
                    <td class="align-middle"><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">編集</button></td>
                    <td class="align-middle"><button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteMemberModal">消去</button></td>
                </tr>
                <tr>
                    <th class="align-middle" scope="row">2</th>
                    <td class="align-middle">a</td>
                    <td class="align-middle">s</td>
                    <td class="align-middle">s</td>
                    <td class="align-middle">
                        <div>
                            <p class="m-0 p-0">personal.codemaker@gmail.com</p>
                            <p class="m-0 p-0">11-1111-1111</p>
                        </div>
                    </td>
                    <td class="align-middle"><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">編集</button></td>
                    <td class="align-middle"><button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteMemberModal">消去</button></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ url('/members') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">会員情報</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">法人名</label>
                            <div class="col-sm-8">
                                <input class="form-control" value="{{ old('company_name') }}" required name="company_name" type="text" placeholder="法人名" aria-label="default input example">
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-8">
                                        @if ($errors->has('company_name'))
                                            <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">担当者氏名</label>
                            <div class="col-sm-8">
                                <input class="form-control" value="{{ old('manager_name') }}" required name="manager_name" type="text" placeholder="担当者氏名" aria-label="default input example">
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-8">
                                        @if ($errors->has('manager_name'))
                                            <span class="text-danger">{{ $errors->first('manager_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">担当者ふりがな</label>
                            <div class="col-sm-8">
                                <input class="form-control" value="{{ old('furigana_name') }}" required name="furigana_name" type="text" placeholder="担当者ふりがな" aria-label="default input example">
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-8">
                                        @if ($errors->has('furigana_name'))
                                            <span class="text-danger">{{ $errors->first('furigana_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">メールアドレス</label>
                            <div class="col-sm-8">
                                <input type="email" value="{{ old('email') }}" name="email" required class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-8">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">パスワード</label>
                            <div class="col-sm-8">
                                <input type="password" value="{{ old('password') }}" required name="password" class="form-control" id="inputPassword">
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-8">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">電話番号</label>
                            <div class="col-sm-8">
                                <input class="form-control" value="{{ old('phone_number') }}" required name="phone_number" type="text" placeholder="1234567890" aria-label="default input example">
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-8">
                                        @if ($errors->has('phone_number'))
                                            <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">郵便番号</label>
                            <div class="col-sm-8 d-flex justify-content-between">
                                <div class="w-25">
                                    <input class="form-control" value="09" name="post_code_prefix" required readonly type="text" placeholder="000">
                                </div>
                                -
                                <div class="w-50">
                                    <input class="form-control" value="{{ old('郵便番号') }}" required name="郵便番号" type="text" placeholder="0000">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-8">
                                        @if ($errors->has('郵便番号'))
                                            <span class="text-danger">{{ $errors->first('郵便番号') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">住所</label>
                            <div class="col-sm-8">
                                <input class="form-control" value="{{ old('location') }}" required name="location" type="text" placeholder="shikoku" aria-label="default input example">
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-8">
                                        @if ($errors->has('location'))
                                            <span class="text-danger">{{ $errors->first('location') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="street_adress" class="col-sm-4 col-form-label">番地</label>
                            <div class="col-sm-8">
                                <input class="form-control" value="{{ old('street_adress') }}" name="street_adress" required type="text" placeholder="112" aria-label="default input example">
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-8">
                                        @if ($errors->has('street_adress'))
                                            <span class="text-danger">{{ $errors->first('street_adress') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">ビル名</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="building_name" type="text" placeholder="123ビル名" aria-label="default input example">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取り消す</button>
                        <button type="submit" class="btn btn-primary">確認</button>
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
