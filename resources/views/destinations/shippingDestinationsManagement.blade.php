@extends('layouts.app')

@section('content')
<div class="container-full mx-5">
    <div class="row justify-content-center">
        <div class="col-12 mb-4">
            <div class="row border-bottom">
                <div class="col-5"></div>
                <div class="col-3">
                    <div><h3>発送先一覧</h3></div>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
        <div class="col-12">
            <div class="row mb-2">
                <div class="col-xl-2 col-sm-8">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>クライアントで絞り込み</label>
                            <input class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-xl-10 col-sm-4 align-self-end"><button type="button" id="addDestinationButton" class="btn btn-warning float-end align-self-end mx-xl-2" data-bs-toggle="modal" data-bs-target="#newAndEditDestinationModal">発送先の新規登録</button></div>
            </div>
            <div class="row mb-1">
                <div class="col-xl-2 col-sm-12">
                    <div class="row">
                        <div class="col-xl-12 col-sm-8">
                            <label>発送先名で絞り込む</label>
                            <input class="form-control my-2">
                        </div>
                        <div class="col-xl-12 col-sm-4">
                            <label>表示件数を変更する</label>
                            <select class="form-select my-2" aria-label="Default select example">
                                <option selected>10</option>
                                <option value="1">20</option>
                                <option value="2">30</option>
                                <option value="3">40</option>
                                <option value="3">50</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-0"></div>
                <div class="col-xl-8 col-sm-12">
                    <div class="row p-2 border-bottom border-top">
                        <div class="col-md-6">
                            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                <div class="col-12 p-4 d-flex flex-column position-static">
                                    <strong class="d-inline-block mb-2 text-primary">発送先用の管理ラベルをここに表示</strong>
                                    <p class="mb-0">郵便番号を表示 000-0000</p>
                                    <p class="mb-0">Tokyo 5番地 apartment</p>
                                    <p class="card-text mb-auto">電話番号を表示 1234567890</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-6"><button type="button" class="btn btn-primary w-75 float-end" data-bs-toggle="modal" data-bs-target="#newAndEditDestinationModal">編集</button></div>
                                <div class="col-6"><button type="button" class="btn btn-danger w-75 float-end" data-bs-toggle="modal" data-bs-target="#confirmInputedData">削除</button></div>
                            </div>
                        </div>
                    </div>
                    <div class="row p-2 border-bottom border-top">
                        <div class="col-md-6">
                            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                <div class="col-12 p-4 d-flex flex-column position-static">
                                    <strong class="d-inline-block mb-2 text-primary">発送先用の管理ラベルをここに表示</strong>
                                    <p class="mb-0">郵便番号を表示 000-0000</p>
                                    <p class="mb-0">Tokyo 5番地 apartment</p>
                                    <p class="card-text mb-auto">電話番号を表示 1234567890</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-6"><button type="button" class="btn btn-primary w-75 float-end" data-bs-toggle="modal" data-bs-target="#newAndEditDestinationModal">編集</button></div>
                                <div class="col-6"><button type="button" class="btn btn-danger w-75 float-end" data-bs-toggle="modal" data-bs-target="#confirmInputedData">削除</button></div>
                            </div>
                        </div>
                    </div>
                    <div class="row p-2 border-bottom border-top">
                        <div class="col-md-6">
                            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                <div class="col-12 p-4 d-flex flex-column position-static">
                                    <strong class="d-inline-block mb-2 text-primary">発送先用の管理ラベルをここに表示</strong>
                                    <p class="mb-0">郵便番号を表示 000-0000</p>
                                    <p class="mb-0">Tokyo 5番地 apartment</p>
                                    <p class="card-text mb-auto">電話番号を表示 1234567890</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-6"><button type="button" class="btn btn-primary w-75 float-end" data-bs-toggle="modal" data-bs-target="#newAndEditDestinationModal">編集</button></div>
                                <div class="col-6"><button type="button" class="btn btn-danger w-75 float-end" data-bs-toggle="modal" data-bs-target="#confirmInputedData">削除</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-4"></div>
                <div class="col-4">
                    {{-- <button type="button" id="newDestinationButton" class="btn btn-primary w-75" data-bs-toggle="modal" data-bs-target="#newAndEditDestinationModal">更新する</button> --}}
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="newAndEditDestinationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="newDestinationForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">発送先登録 / 編集</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">依頼ID</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" placeholder="依頼ID" name="clientId" id="clientId" value="">
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-8">
                                        <small class="text-danger" id="clientId_Error"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">発送先名</label>
                            <div class="col-sm-8">
                                <input class="form-control" id="destinationName" name="destinationName" type="text" placeholder="発送先名" aria-label="default input example">
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-8">
                                        <small class="text-danger" id="destinationName_Error"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">郵便番号</label>
                            <div class="col-sm-8 d-flex justify-content-between">
                                <div class="w-25">
                                    <input class="form-control" id="post_code_prefix" value="09" name="post_code_prefix" readonly type="text" placeholder="000">
                                </div>
                                -
                                <div class="w-50">
                                    <input class="form-control" id="post_code_suffix" name="post_code_suffix" type="text" placeholder="0000">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-8">
                                        <small class="text-danger" id="post_code_suffix_Error"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">住所</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" id="adressName" name="adressName" placeholder="shikoku" aria-label="default input example">
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-8">
                                        <small class="text-danger" id="adressName_Error"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">番地</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" id="locationName" name="locationName" placeholder="112" aria-label="default input example">
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-8">
                                        <small class="text-danger" id="locationName_Error"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlInput1" class="col-sm-4 col-form-label">ビル名</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" placeholder="123ビル名" aria-label="default input example">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" id="cancelAddButton" class="btn btn-secondary" data-bs-dismiss="modal">取り消す</button>
                    <button type="button" id="addAndEditDestinationConfirmButton" class="btn btn-primary">確認</button>
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
