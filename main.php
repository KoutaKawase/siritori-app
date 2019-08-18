<?php

function printStartMessage(): void {
    print("===================================\n");
    print("しりとりへようこそ！\n");
    print("まずコンピュータが最初のワードを出題するので、それに続けてください。\n");
    print("「ん」で終わると負けです！\n");
    print("===================================\n");
}

function getFirstWord(): string {
    $rand_word = '';
    $words = ['りんご', 'ごりら', 'ラッパ', 'うんち'];
    $rand_key = array_rand($words);
    $rand_word = $words[$rand_key];
    print("最初のワードは「" . $rand_word . "」です。\n");
    return $words[$rand_key];
}

function getInputWord(): string {
    echo("ワードを入力してください>> ");
    $input = trim(fgets(STDIN));
    return $input;
}

function compareWord(string $beforeWord, string $inputWord): bool {
    $firstWord = '';
    $lastWord = '';
    //文字を全てひらがなに変換
    $beforeWord = mb_convert_kana($beforeWord, "c", "UTF-8");
    $inputWord = mb_convert_kana($inputWord, "c", "UTF-8");
    //最初のワードと最後のワードを取得
    $firstWord = mb_substr($inputWord, 0, 1);
    $lastWord = mb_substr($beforeWord, -1);
    //最後が「ん」で終わっていたらfalseを返す
    if ($lastWord === 'ん') {
        return false;
    }
    //前のワードの最後とインプットの最初を比較
    if ( $lastWord === $firstWord ) {
        return true;
    } else {
        return false;
    }
}

function main(): void {
    $word = '';
    //スタートメッセージ
    printStartMessage();
    //ランダムに最初のワードを取得
    $word = getFirstWord();
    while(true) {
        $lastWord = '';
       //入力を受付
        $input = getInputWord();
        //最後のワード取得
        $lastWord = mb_substr($input, -1);
        //前のワードの最後と比較した結果を取得 「ん」の場合もfalse
        $isEqual = compareWord($word, $input);
        //同じならもう一度
        if ($isEqual) {
            print("いいね！ 「" . $lastWord . "」から始まるワードを考えよう！\n");
            $word = $input;
        } else {
            print("正しくない単語です！あなたの負けです！\n");
            break;
        }
    }
    print("またね！\n");
}

main();