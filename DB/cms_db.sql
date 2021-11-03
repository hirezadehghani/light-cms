-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2021 at 01:43 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(10, 'جدی طور'),
(11, 'نغمه های زندگی'),
(13, 'اندیشه ها'),
(14, 'تجارت الکترونیکی');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `comment` text COLLATE utf8_persian_ci NOT NULL,
  `post_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `comment`, `post_id`, `status`) VALUES
(1, 'رضا دهقانی', 'در این پروژه از لورم ایپسوم استفاده نشده است.\r\nاین مطلب رو در وبسایت hireza.ir منتشر کرده ام.', 15, 1),
(2, 'رضا دهقانی', 'قسمت های پایین نظرات برنامه نویسی نشده است ولی قابل پیاده سازی است.\r\nبرای اطلاعات بیشتر با من از طریق hireza.ir تماس بگیرید.', 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8_persian_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `body` text COLLATE utf8_persian_ci NOT NULL,
  `author` varchar(191) COLLATE utf8_persian_ci NOT NULL,
  `image` varchar(191) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `category_id`, `body`, `author`, `image`) VALUES
(8, 'و چه زیباست صبح و نغمه پرندگان و باران', 11, '<p>آفتاب سوزان و پرندگان به این طرف و آن طرف می دویدند، درخت بادام از شدت گرما صورتش به زردی می زد. پیرمردی دنیا دیده که از سایه کنار خیابان میگذشت ناامید در افکارش غوطه ور بود:</p><p>بهار امسال بارانی نبارید دیگر کی میخواهد باران ببارد؛ علف های بیابان هم دیگر مرده اند، آب آبادی هفته ای یک بار وصل می شود، دلم به حال علف های بیابان می سوزد یعنی خدا به این زبان بسته ها هم رحمی ندارد…</p><p>روزها از پی هم به سرعت می دوید تا برج رمضان از راه رسید؛ کشاورزان جوهای شان را درو کرده بودند و فقط بعضی هنوز گندم هایشان را درو نکرده بودند.</p><p>همه از سختی امسال و خشکسالی می گفتند، تقریبا هیچ کس امیدی نداشت.</p><p>19 روز از رمضان گذشت دیگر کسی به فکر نبود بعضی ها نعوذ بالله به شک افتاده بودند.</p><p>تا اینکه شب نوزدهم صدای صاعقه همه را لرزاند، برق رفت و همه غافلگیر شدند: چند ثانیه بعد نغمه باران از هر طرف به صدا درآمد، جیغ شادی بچه ها امید را به بطن قلب ناامید یخ زده مردم رساند و گویی قلب مردم دوباره سبز شد، تقریبا هیچ کس حتی فکرش را هم نمی کرد بعد از آن همه صاعقه های بی باران؛ این چنین بارانی ببارد.</p>', 'رضا دهقانی', '97269_731.jpg'),
(15, 'آیا اینماد الزامی است؟', 14, '<p>وقتی داشتم یکی از سایت های افراد به ظاهر (در عمل رو نمی تونم قضاوت کنم) موفق (حالا از چه نظر؟ خیلیاشون میگن پول یا ثروت) رو می دیدم به نکته‌ی خیلی جالبی برخوردم. بزارین سایتش رو هم بگم سایت <a href=\"https://abasmanesh.com/fa/shop/\">عباس منش</a>.</p><p>من چند سال پیش سایتشون رو دیده بودم و به نوعی کاربری محسوب می‌شدم که میشه گفت با برند عباس منش آشنایی داره و توی قیف مشتری اون مراحل آخر رو طی می کنه (قیف مشتری = قیفی هست که در مباحث فروش مطرح شده و مراحل آخرش به این معنی هست که مشتری به سمت خرید نزدیک تر میشه).</p><p>پس قاعدتاْ به این سایت (اگه میخواستم خریدی انجام بدم) اعتماد داشتم. اما نکته ای که نباید هیچوقت فراموش کنیم اینه که همیشه پای اعتماد که میاد وسط خیلی عوامل مثل بازاریابی و فروش و … توش دخیل هستن.</p><p>یک وبسایت شاید روی این موارد خیلی کار کرده باشه و باعث اعتماد کاربر بشه و کاربر اگه بخواد خریدی در سایت انجام بده کاملاْ مطمئنه که آقای عباس منش کلاهبردار نیست یا … و بیاد به همون واسطه خریدش رو انجام بده؛ ولی باز هم بطور ناخودآگاه افراد بدبینی (و شاید سینه سوخته از کلاهبرداری های اینترنتی)مثل من حتماْ میان و مجوز های قانونی رو بررسی می کنن.</p><p>همون طور که تا اینجا این مقاله رو خوندین باید شما هم مثل من تعجب کرده باشید که چرا وبسایت <strong>عباس منش</strong> با این <strong>سابقه </strong>نماد اعتماد الکترونیکی یا <strong>اینماد</strong> نداره؟!</p><p>برای همین برام سوال شد؟ واقعا برای فروش اینترنتی نیاز به اینماد هست؟ <strong>الزاماْ خیر</strong></p><p>یعنی حتما نیاز نیست که در شروع یک کسب و کار اینترنتی اینماد داشته باشه اما این سایت با این سابقه فرق می کنه.</p><p>خب شاید بپرسین اصلاْ اینماد به چه دردی می خوره؟</p><p>خیلی ساده است شکایت از سایت در صورت ندادن خدمت یا محصول چه فیزیکی چه غیر فیزیکی مثلا فایل دانلودی. یا عدم عودت وجه کیف پول شما در وبسایت که این مورد یک خورده پیچیده تره و نمی خوام اینجا بهش بپردازم.</p><p>خب فرض کنید یکی از بستگان یا دوستان مورد اعتماد ما این وبسایت رو معرفی کرده باشه: اون موقع قطعاْ‌ اعتماد ما خیلی بیشتر از حالتی که گذری با وبسایت آشنا شدیم جلب شده. پس میریم و خرید رو انجام میدیم.</p><p>و اگه خدایی نکرده با بدقولی سایت (مثلاْ‌ پیش خرید یک محصول دانلودی و حاضر نشدن محصول به موقع یا خطای پستی در محصولات فیزیکی یا خرید وبینار آنلاین و مشکل فنی موقع برگزاری وبینار) مواجه بشیم چه تضمینی وجود داره که در صورت پاسخگو نبودن سایت از طریق مراجع قانونی بتونیم موضوع رو به نتیجه برسونیم؟ <strong>بدون اینماد مسلماْ هیچی</strong>.</p><p>این موارد رو خواهشاْ ساده نگیرید: یک مورد دیگه‌ای که از دیدنش در سایت عباس منش بهت زده شده بودم این بود که:</p><blockquote><p style=\"text-align:center;\"><strong>‌‌بعد از دانلود فایلهای محصولات، آنها را در مکانی امن در کامپیوتر خود ذخیره کنید زیرا بر طبق شرایط و ضوابط سایت‌، ممکن است </strong><span style=\"color:rgb(255,0,0);\"><strong>۶ ماه پس از تاریخ خرید شما‌، لینک‌های دانلود حذف شود</strong></span><strong>.</strong></p></blockquote><p>اگه مشتری این پیغام رو نبینه یا جدی نگیره و بعد از اون مدت فایلی که خریده حذف بشه یا در مثال دیگه‌ای موقع خرید یک گوشی از فروشگاه مثلاْ دیجی فلان گوشی ساخت چین بجای کشور مدنظر مشتری باشه اون موقع چه اتفاقی میوفته؟</p><p>وقتی سایت اینماد داره خیلی راحت از سایت شکایت میکنید و کل پول تون مرجوع میشه اما وقتی نباشه باید هر دری بزنید تا شاید بتونید از پشتیبانی یا صاحب سایت پول‌تون رو پس بگیرید.</p><p>مزیت اینماد اینه که <strong>باعث اعتماد کاربر</strong> میشه و <strong>برای درگاه های پرداخت مستقیم (نه واسط!)</strong> الزامی هست. اما باز مورد دیگه ای من در بررسی وبسایت عباس منش بهش برخوردم این بود که سایت درگاه پرداخت مستقیم سداد بانک ملی رو داشت!</p><p>موارد نارضایتی در سایت های بدون اینماد وجود داره: همین چند وقت پیش وقتی سایت <strong>احمد کلاته</strong> (یکی دیگر از به ظاهر موفقان) رو از طریق تبلیغات وسیع اینترنتی بررسی می کردم برای اینکه سنجیدن بازدهیش و صحت ادعاهای این فرد (قضاوت نمی کنم اما به نتیجه‌ای نرسیدم) اسمش رو در گوگل سرچ کردم و حدس می زنید به چی رسیدم؟</p><p>نارضایتی یک مشتری! اصلاْ نمی خوام به اینکه حق با مشتری بود یا نبود بپردازم؛ این وبسایت اتفاقاْ اینماد داشت و مشتری که از این وبسایت دوره ای رو خریداری کرده بود تونسته بود از طریق اینماد با پیگیری به پولش برسه اصلاْ نمی خوام ماهیت سایت رو با هم مقایسه فقط می خوام تفاوت داشتن اینماد رو ببینید.</p><p>چه بسا افرادی که با سهل انگاری مبالغ زیادی از این موضوع متضرر شدند.</p>', 'رضا دهقانی', 'enamad.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `posts_slider`
--

CREATE TABLE `posts_slider` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `posts_slider`
--

INSERT INTO `posts_slider` (`id`, `post_id`, `active`) VALUES
(13, 8, 1),
(17, 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(191) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`) VALUES
(1, 'hello.dehghani@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'admin', 'hireza.ir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `posts_slider`
--
ALTER TABLE `posts_slider`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `posts_slider`
--
ALTER TABLE `posts_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts_slider`
--
ALTER TABLE `posts_slider`
  ADD CONSTRAINT `posts_slider_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
