INSERT INTO `snail_class` (`sid`, `category`, `classname`, `date`, `amount`) VALUES 
(NULL, '體驗DIY', '陶碗製作', '2020-12-10 20:41:59', '3'),
(NULL, '體驗DIY', '盤子製作', '2020-12-20 20:41:59', '5'),
(NULL, '體驗DIY', '花器製作', '2020-12-25 20:41:59', '1'),
(NULL, '體驗DIY', '陶碗製作', '2020-12-10 20:41:59', '3'),
(NULL, '體驗DIY', '盤子製作', '2020-12-20 20:41:59', '5'),
(NULL, '體驗DIY', '花器製作', '2020-12-25 20:41:59', '1'),
(NULL, '體驗DIY', '陶碗製作', '2020-12-10 20:41:59', '3'),
(NULL, '體驗DIY', '盤子製作', '2020-12-20 20:41:59', '5'),
(NULL, '體驗DIY', '花器製作', '2020-12-25 20:41:59', '1'),
(NULL, '體驗DIY', '陶碗製作', '2020-12-10 20:41:59', '3'),
(NULL, '體驗DIY', '盤子製作', '2020-12-20 20:41:59', '5'),
(NULL, '體驗DIY', '花器製作', '2020-12-25 20:41:59', '1'),
(NULL, '體驗DIY', '陶碗製作', '2020-12-10 20:41:59', '3'),
(NULL, '體驗DIY', '盤子製作', '2020-12-20 20:41:59', '5'),
(NULL, '體驗DIY', '花器製作', '2020-12-25 20:41:59', '1'),
(NULL, '體驗DIY', '陶碗製作', '2020-12-10 20:41:59', '3'),
(NULL, '體驗DIY', '盤子製作', '2020-12-20 20:41:59', '5'),
(NULL, '體驗DIY', '花器製作', '2020-12-25 20:41:59', '1'),
(NULL, '體驗DIY', '陶碗製作', '2020-12-10 20:41:59', '3'),
(NULL, '體驗DIY', '盤子製作', '2020-12-20 20:41:59', '5'),
(NULL, '體驗DIY', '花器製作', '2020-12-25 20:41:59', '1'),
(NULL, '體驗DIY', '陶碗製作', '2020-12-10 20:41:59', '3'),
(NULL, '體驗DIY', '盤子製作', '2020-12-20 20:41:59', '5'),
(NULL, '體驗DIY', '花器製作', '2020-12-25 20:41:59', '1'),
(NULL, '體驗DIY', '壓花彩繪', '2020-12-30 20:41:59', '3');


-- 新增
-- 沒有給值就是自動給空字串
 INSERT INTO `snail_class`( `category`, `classname`, `date`, `amount`
 )  VALUES (
     ?,?,?,?
 );