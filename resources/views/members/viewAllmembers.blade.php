@extends('layouts.app')

@section('content')
<div class="container-full mx-5">
    <div class="row justify-content-center">
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">法人名</th>
                    <th scope="col">担当者氏名</th>
                    <th scope="col">担当者ふりがな</th>
                    <th scope="col">メールアドレス</th>
                    <th scope="col">電話番号</th>
                    <th scope="col">郵便番号</th>
                    <th scope="col">住所</th>
                    <th scope="col">番地</th>
                    <th scope="col">ビル名</th>
                    <th scope="col">編集</th>
                    <th scope="col">消去</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
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
