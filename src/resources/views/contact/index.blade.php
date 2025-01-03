@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>
    <form class="form" action="/confirm" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label-item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name', $input['last_name'] ?? '') }}">&emsp;
                    <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name', $input['first_name'] ?? '') }}">
                </div>
            </div>
            <div class="form__error">
                @error('last_name')
                    {{ $message }}
                @enderror
            </div>
            <div class="form__error">
                @error('first_name')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label-item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--radio">
                    <input type="radio" name="gender" value="1" {{ old('gender', $input['gender'] ?? '') == '1' ? 'checked' : '' }} checked><span>男性</span>
                    <input type="radio" name="gender" value="2" {{ old('gender', $input['gender'] ?? '') == '2' ? 'checked' : '' }}><span>女性</span>
                    <input type="radio" name="gender" value="3" {{ old('gender', $input['gender'] ?? '') == '3' ? 'checked' : '' }}><span>その他</span>
                </div>
            </div>
            <div class="form__error">
                @error('gender')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label-item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="email" placeholder="例: test@example.com" value="{{ old('email', $input['email'] ?? '') }}">
                </div>
            </div>
            <div class="form__error">
                @error('email')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label-item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="tel1" id="tel1" maxlength="4" placeholder="080" value="{{ old('tel1', $input['tel1'] ?? '') }}"> <span>-</span>
                    <input type="text" name="tel2" id="tel2" maxlength="4" placeholder="1234" value="{{ old('tel2', $input['tel2'] ?? '') }}"> <span>-</span>
                    <input type="text" name="tel3" id="tel3" maxlength="4" placeholder="5678" value="{{ old('tel3', $input['tel3'] ?? '') }}">
                </div>
            </div>
            <div class="form__error">
                @error('tel')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label-item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address', $input['address'] ?? '') }}">
                </div>
            </div>
            <div class="form__error">
                @error('address')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label-item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building', $input['building'] ?? '') }}">
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label-item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__select">
                    <select name="category_id">
                        <option value="" disabled selected style="display:none;">選択してください</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}" {{ old('category_id', $input['category_id'] ?? '') == $category['id'] ? 'selected' : '' }}>{{ $category['content'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form__error">
                @error('category_id')
                    {{ $message }}
                @enderror
            </div>
        </div>
        
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label-item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', $input['detail'] ?? '') }}</textarea>
                </div>
            </div>
            <div class="form__error">
                @error('detail')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection