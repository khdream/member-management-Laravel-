@extends('layouts.app')

@section('content')
<div class="container-full mx-5">
    <div class="row justify-content-center">
        <div>
            <h3>会員一覧</h3>
        </div>
        <table class="table table-hover text-center">
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
                    <td class="align-middle"><button type="button" class="btn btn-outline-primary">編集</button></td>
                    <td class="align-middle"><button type="button" class="btn btn-outline-danger">消去</button></td>
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
                    <td><button type="button" class="btn btn-outline-primary">編集</button></td>
                    <td><button type="button" class="btn btn-outline-danger">消去</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
