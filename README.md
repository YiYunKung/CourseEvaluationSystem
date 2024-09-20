# 課程評價系統📝－更貼近學生的設計
詳細介紹可下載查看 [評價系統報告簡報](https://github.com/YiYunKung/courseEvaluationSystem/blob/main/%E8%A9%95%E5%83%B9%E7%B3%BB%E7%B5%B1%E4%BB%8B%E7%B4%B9.pptx) 
<br>

## 功能及特點介紹
該系統最大的特色在於**評價內容的設計** ，除了評分、考試、作業、心得這些較常見的問題外，還包含：
* **選課熱度**
* **學生到課頻率**
* **是否通過課程**
* **教授評價與上課風格**<br>

我們懂系統使用者（選課學生）需要的！
<br> <br>
### 使用者權限
分為兩種身分，分別為已登入、未登入兩種情況<br>
* 已登入：可觀看他人評價、好課排行榜、寫下評價<br>
* 未登入：僅供查看他人評價、排行榜

### 註冊
* 必須使用以@g.ncyu.edu.tw為址的學校帳戶申辦
* 若註冊成功會先跳回登入頁面，登入成功後跳轉至首頁，網站右上顯示歡迎字樣

### 首頁
* 根據不同評分項目作統計，顯示不同的**排行榜**
* 排行榜將顯示評分最高的前10名課程

![image](https://github.com/user-attachments/assets/82668f67-e18b-4121-b0af-4559aa35c047)
![image](https://github.com/user-attachments/assets/a2c8cd3e-d307-4792-9c93-b16080e4a46e)


### 查看評價
* 點選功能表的「課程查詢」，依學院、系名來查詢
* 點入課程即可看到該課程的相關資訊及評價

### 留下評價
* 登入後直接點選首頁的「前往評價」字樣
* 進入課程查詢，點入想要評價的課程，點選「前往評論該課程」

![image](https://github.com/user-attachments/assets/ea1528a7-c838-4242-86b7-c7015903a790)
![image](https://github.com/user-attachments/assets/2ff7a1b5-0e17-4149-8aeb-4e404531820a)
<br>

## 使用的特殊套件
* 透過下列程式碼引入Bootstrap <br>
`<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>` <br><br>
這個 <script> 標籤引入了 Bootstrap 的 JavaScript 檔案，其中 bootstrap.bundle.min.js 是包含 Bootstrap 所有 JavaScript 插件的壓縮版本。這個檔案包含了彈出視窗、導覽欄下拉功能、滾動動畫等 Bootstrap 功能所需的 JavaScript 代碼。
 <br><br>
+ 使用 Bootstrap 的 CSS 樣式，但在程式碼中並沒有直接引入 Bootstrap 的 CSS 檔案，而是在css/styles.css 中進行了一些自訂樣式 <br>
參考：https://getbootstrap.com/
<br>

## 團隊成員
* **龔弋筠 1102914－資料庫設計及管理、課程列表功能、評價功能**
* 游雅碩 1102916－資料庫設計及管理、課程列表功能、評價功能
* 洪唯翔 1102926－資料爬蟲、帳號登入及註冊功能
* 黃建澄 1102936－資料爬蟲、首頁設計
