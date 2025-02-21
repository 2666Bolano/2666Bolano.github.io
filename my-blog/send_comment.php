<?php
// 检查是否为 POST 请求，确保只有通过表单提交时才处理数据
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. 获取并清理表单数据
    // trim() 去除字符串首尾空白，strip_tags() 移除可能的 HTML 标签
    $name = strip_tags(trim($_POST["name"]));
    // 对邮箱进行过滤，去除非法字符
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // 2. 设置邮件的接收地址、主题和内容
    // 将接收邮件的地址修改为你的邮箱：1736486240@qq.com
    $email_to = "1736486240@qq.com";  
    $subject = "新评论来自：$name";
    $body = "姓名：$name\n邮箱：$email\n\n留言内容：\n$message";
    
    // 设置邮件头，其中 From 和 Reply-To 使用用户填写的邮箱
    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n";

    // 3. 使用 mail() 函数发送邮件
    if(mail($email_to, $subject, $body, $headers)){
        // 如果邮件发送成功，向用户展示反馈页面
        echo "<!DOCTYPE html>
        <html lang='zh-CN'>
        <head>
          <meta charset='UTF-8'>
          <meta name='viewport' content='width=device-width, initial-scale=1.0'>
          <title>评论提交成功</title>
          <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
          <link rel='stylesheet' href='style.css'>
        </head>
        <body class='d-flex flex-column min-vh-100'>
          <div class='container my-5'>
            <div class='alert alert-success text-center'>
              感谢您的留言！我们会尽快审核后更新到评论区。
            </div>
            <div class='text-center'>
              <a href='contact.html' class='btn btn-primary'>返回联系页面</a>
            </div>
          </div>
          <footer class='bg-dark text-white py-4 mt-auto'>
            <div class='container text-center'>
              <p class='mb-0'>© 2025 我的博客. 保留所有权利。</p>
            </div>
          </footer>
          <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>
        </body>
        </html>";
    } else {
        // 如果邮件发送失败，则提示用户稍后重试
        echo "发送评论失败，请稍后重试。";
    }
} else {
    // 如果不是 POST 请求，则提示为无效的请求
    echo "无效的请求。";
}
?>
