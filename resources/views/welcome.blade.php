@extends('layouts.app')

@section('content')
<div class="hero is-info is-bold">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">Photo Club</h1>
      <h2 class="subtitle">こだわりの写真をシェアしよう。</h2>
    </div>
  </div>
</div>
<section class="section">
  <div class="container">
    <h1 class="title">こだわりの写真をシェア！</h1>
    <h2 class="subtitle">
      いわゆる「映える」写真にあなたの素晴らしい写真が埋もれていませんか？このサービスは写真が好きな人向けの芸術的な写真をシェアできるサービスです。
      まずは新規登録しましょう!<br>
      <p>
        <a class="button is-large is-info" href="register">
          <span class="icon is-medium">
            <i class="fas fa-plus-square"></i>
          </span>
          <span>新規登録</span>
        </a>
      </p>
    </h2>
  </div>
</section>

<footer class="footer">
  <div class="content has-text-centered">
    <p>
      <strong>PhotoClub</strong> by Noyatsu.
    </p>
  </div>
</footer>
