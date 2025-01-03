@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

<style>

</style>

@section('header-nav')
<form action="/logout" method="post">
    @csrf
    <button class="header-nav__button" type="submit">logout</button>
</form>
@endsection

@section('content')
<div class="admin__container">
    <div class="admin__content">
        <div class="admin-form__heading">
            <h2>Admin</h2>
        </div>
        <form class="admin-form">
            <div class="admin-form__item" action="/admin" method="get">
                <input class="form__item form__item-input" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="名前やメールアドレスを入力してください">
                <select class="form__item form__item-select--gender" name="gender">
                    <option value="" disabled selected style="display:none;">性別</option>
                    <option value="1" {{ $gender == '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ $gender == '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ $gender == '3' ? 'selected' : '' }}>その他</option>
                </select>
                <select class="form__item form__item-select--category" name="category_id">
                    <option value="" disabled selected style="display:none;">お問い合わせの種類</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}" {{ $category_id == $category['id'] ? 'selected' : '' }}>{{ $category['content'] }}</option>
                    @endforeach
                </select>
                <input class="form__item form__item-input--date" type="date" name="" placeholder="年/月/日" value="{{ $date ?? '' }}">
                <div class="form__button">
                    <button class="form__button-submit" type="submit">検索</button>
                    <a class="form__button-reset" href="/admin">リセット</a>
                </div>
            </div>
        </form>
        <div class="contact-table">
            <div class="contact-table__pagination">
                {{ $contacts->links() }}
            </div>
            <table class="contact-table__inner">
                <tr class="contact-table__row">
                    <th class="contact-table__header col-1">お名前</th>
                    <th class="contact-table__header col-2">性別</th>
                    <th class="contact-table__header col-3">メールアドレス</th>
                    <th class="contact-table__header col-4">お問い合わせの種類</th>
                    <th class="contact-table__header col-5">&emsp;</th>
                </tr>
                @foreach ($contacts as $contact)
                <tr class="contact-table__row">
                    <td class="contact-table__item col-1">{{ $contact['last_name'] }}&ensp;{{ $contact->first_name }}</td>
                    <td class="contact-table__item col-2">
                        @if ($contact['gender'] == '1')
                        男性
                        @elseif ($contact['gender'] == '2')
                        女性
                        @else ( $contact['gender'] == '3')
                        その他
                        @endif
                    </td>
                    <td class="contact-table__item col-3">{{ $contact['email'] }}</td>
                    <td class="contact-table__item col-4">{{ $contact->category->content }}</td>
                    <td class="contact-table__item col-5">
                        <button class="contact-table__item-button" popovertarget="popover{{ $contact['id'] }}">詳細</button>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    
        <!-- モーダルウィンドウ -->
        @foreach ($contacts as $contact)
        <div class="modal" id="popover{{ $contact['id'] }}" popover>
            <div class="modal__container">
                <div class="modal__container-close">
                    <button class="modal__close-button" popovertarget="popover{{ $contact['id'] }}" popovertargetaction="hide">×</button>
                </div>
                <div class="modal__content">
                    <table class="modal-table">
                        <tr class="modal-table__row">
                            <th class="modal-table__header">お名前</th>
                            <td class="modal-table__text">{{ $contact['last_name'] }} {{ $contact['first_name'] }}</td>
                        </tr>
                        <tr class="modal-table__row">
                            <th class="modal-table__header">性別</th>
                            <td class="modal-table__text">
                                @if ($contact['gender'] == '1')
                                男性
                                @elseif ($contact['gender'] == '2')
                                女性
                                @else ( $contact['gender'] == '3')
                                その他
                                @endif
                            </td>
                        </tr>
                        <tr class="modal-table__row">
                            <th class="modal-table__header">メールアドレス</th>
                            <td class="modal-table__text">{{ $contact['email'] }}</td>
                        </tr>
                        <tr class="modal-table__row">
                            <th class="modal-table__header">電話番号</th>
                            <td class="modal-table__text">{{ $contact['tel'] }}</td>
                        </tr>
                        <tr class="modal-table__row">
                            <th class="modal-table__header">住所</th>
                            <td class="modal-table__text">{{ $contact['address'] }}</td>
                        <tr class="modal-table__row">
                            <th class="modal-table__header">建物名</th>
                            <td class="modal-table__text">{{ $contact['building'] }}</td>
                        <tr class="modal-table__row">
                            <th class="modal-table__header">お問い合わせの種類</th>
                            <td class="modal-table__text">{{ $contact->category->content }}</td>
                        <tr class="modal-table__row">
                            <th class="modal-table__header">お問い合わせの内容</th>
                            <td class="modal-table__text">{{ $contact['detail'] }}</td>
                        </tr>
                    </table>
                </div>
                <div>
                    <form class="delete-form"  action="/admin" method="post">
                        @method('DELETE')
                        @csrf
                        <div class="delete-form__button">
                            <input type="hidden" name="" value="{{ $contact['id'] }}">
                            <button class="delete-form__button-submit" type="submit">削除</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection