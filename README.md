# Laravel 11 自動產生應用程式介面文件

引入 dedoc 的 scramble 套件來擴增自動產生應用程式介面文件，無需手動撰寫 PHPDoc（註解 PHP 程式碼的非正式標準）註解，文件以 [OpenAPI](https://www.openapis.org/) 3.1.0 格式產生。

## 使用方式
- 把整個專案複製一份到你的電腦裡，這裡指的「內容」不是只有檔案，而是指所有整個專案的歷史紀錄、分支、標籤等內容都會複製一份下來。
```sh
$ git clone
```
- 將 __.env.example__ 檔案重新命名成 __.env__，如果應用程式金鑰沒有被設定的話，你的使用者 sessions 和其他加密的資料都是不安全的！
- 當你的專案中已經有 composer.lock，可以直接執行指令以讓 Composer 安裝 composer.lock 中指定的套件及版本。
```sh
$ composer install
```
- 產生 Laravel 要使用的一組 32 字元長度的隨機字串 APP_KEY 並存在 .env 內。
```sh
$ php artisan key:generate
```
- 執行 __Artisan__ 指令的 __migrate__ 來執行所有未完成的遷移，並執行資料庫填充（如果要測試的話）。
```sh
$ php artisan migrate --seed
```
- 在瀏覽器中輸入已定義的路由 URL 來訪問，例如：http://127.0.0.1:8000。
- 你可以經由 `/docs/api` 來進行應用程式介面文件瀏覽。

----

## 畫面截圖
![](https://imgur.com/2hiFbcz.png)
> 應用程式介面文件就像一個地圖，可以指引任何想要與您的系統整合的開發人員

![](https://imgur.com/WObD2T7.png)
> 可以快速了解應用程式介面的功能、預期的回應以及可能發生的錯誤