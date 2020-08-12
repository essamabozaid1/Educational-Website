-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2018 at 01:17 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `white`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Username`, `Password`, `Email`) VALUES
('essam abozaid', '7b52009b64fd0a2a49e6d8a939753077792b0554', 'aaa@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `advertise`
--

CREATE TABLE IF NOT EXISTS `advertise` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `Link` text NOT NULL,
  `titleAr` varchar(255) NOT NULL,
  `textAr` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `advertise`
--

INSERT INTO `advertise` (`ID`, `title`, `text`, `Link`, `titleAr`, `textAr`) VALUES
(1, 'Register now and get a discount 50% discount until 1 January', 'sas', 'https://www.facebook.com/', 'احصل علي خصم 50% علي جميع الكورسات', 'تاهاؤسنى');

-- --------------------------------------------------------

--
-- Table structure for table `career`
--

CREATE TABLE IF NOT EXISTS `career` (
`ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `birthDate` date NOT NULL,
  `letter` text CHARACTER SET utf16 NOT NULL,
  `CV` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `career`
--

INSERT INTO `career` (`ID`, `name`, `email`, `phone`, `birthDate`, `letter`, `CV`, `position`) VALUES
(1, 'Essam Abozaid', 'essamabozaid1@gmail.com', '1011050094', '0000-00-00', '', 'CV_1.pdf', 'Customer Service'),
(2, 'Essam Abozaid', 'essamabozaid12@gmail.com', '1011050094', '0000-00-00', '', 'CV_2.docx', 'germen');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE IF NOT EXISTS `carousel` (
`SlideID` int(11) NOT NULL,
  `SlideImage` varchar(255) NOT NULL,
  `SlideHeader` varchar(255) NOT NULL,
  `SlidePara` text NOT NULL,
  `SlideHeaderAr` varchar(255) NOT NULL,
  `SlideParaAr` text CHARACTER SET ucs2 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`SlideID`, `SlideImage`, `SlideHeader`, `SlidePara`, `SlideHeaderAr`, `SlideParaAr`) VALUES
(1, 'Slide_1.png', 'Get your <span>Education</span> today!', 'Welcome with you in the new look of WHITE HOUSE ACADEMY STYLE Welcome with you in the new look of WHITE HOUSE ACADEMY STYLE', 'احصل علي تعليمك الان', 'اهلا بك في موقع وايت هاوس اكاديمي في شكلة الجديد'),
(2, 'Slide_2.png', 'ahlan bek fe mwq3na', 'hkbbgccc hjfhb frrs llkhjf hgghjhug ', 'احصل علي تعليمك الان', 'تتاعا نت تتالب اننا متنلاال ءيتبق ستى ءقس مننة ىااىزم هفقلىلا   لاتلر تا');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`categoryID` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL,
  `catNameAr` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `visibility` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `catName`, `catNameAr`, `description`, `visibility`) VALUES
(1, 'languages', 'لغات', 'all languages', 0),
(2, 'computer', 'كمبيوتر', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `certification`
--

CREATE TABLE IF NOT EXISTS `certification` (
  `ID` int(11) NOT NULL,
  `studentName` varchar(255) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `startTime` date NOT NULL,
  `endTime` date NOT NULL,
  `hours` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `certification`
--

INSERT INTO `certification` (`ID`, `studentName`, `courseName`, `startTime`, `endTime`, `hours`) VALUES
(201649, 'Essam Abozaid', 'turkish', '0000-00-00', '0000-00-00', 0),
(201651, 'maher', 'law', '2018-04-04', '2018-04-30', 0),
(201659, 'Essam Abozaid', 'german', '2018-04-01', '2018-04-26', 80),
(201680, 'Essam Abozaid', 'turkish', '0000-00-00', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
`clientID` int(7) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `studentCode` varchar(255) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `fileUpload1` longblob
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`clientID`, `userName`, `studentCode`, `fullName`, `email`, `phone`, `fileUpload1`) VALUES
(1, 'ahmed Elmenshawy', '1234', 'ahmed mohamed el menshawy', 'ahmed@yahoo.com', '010123456780', NULL),
(2, 'bahaa', 'bahaa123', 'bahaa elboshy', '', '', NULL),
(3, 'احمد', '123456', 'احمد محمد', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
`courseID` int(11) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `courseNameAr` varchar(255) NOT NULL,
  `descriptionAr` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL,
  `catID` int(11) DEFAULT NULL,
  `popular` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseID`, `courseName`, `description`, `courseNameAr`, `descriptionAr`, `price`, `active`, `image`, `catID`, `popular`) VALUES
(1, 'turkish', 'All languages Expect the english', '', '', '500', 0, 'course_turkish.png', 1, 1),
(3, 'A+', 'learn computer hardware and software', 'صيانة', 'تعلم مكونات الكمبيوتر وكيفيه اصلاحها', '500', 0, 'course_A+.png', 2, 0),
(4, 'drawing', 'all drawing ', 'رسم', 'كل انواع الرسم ', '400', 0, 'course_drawing.png', 2, 0),
(6, 'law', 'all years in law faculty', '', '', '250', 0, 'course_law.png', 2, 0),
(7, 'spanish', 'all languages', '', '', '300', 1, 'course_spanish.png', 1, 0),
(8, 'japanes', 'All languages Expect the english', '', '', '300', 0, 'course_japanes.png', 1, 1),
(9, 'ICDL', 'windows,word,excel,powerpoint..etc', 'اي-سي-دل', 'ويندوز -ورد-اكسل-بوربوينت', '500', 0, 'course_ICDL.png', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
`ID` int(11) NOT NULL,
  `eventDate` date NOT NULL,
  `eventName` varchar(255) NOT NULL,
  `eventLocation` varchar(255) NOT NULL,
  `eventPara` text NOT NULL,
  `eventNameAr` varchar(255) NOT NULL,
  `eventLocationAr` varchar(255) NOT NULL,
  `eventParaAr` text NOT NULL,
  `mainImage` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`ID`, `eventDate`, `eventName`, `eventLocation`, `eventPara`, `eventNameAr`, `eventLocationAr`, `eventParaAr`, `mainImage`) VALUES
(2, '2018-04-03', 'mother Day', 'White House', 'adsadaaaaaaaaaaaaaaaaa', 'عيد الام', 'وايت هاوس', 'ليخسة ثخلتس ثس سمتلسم للسنتىل مشت ملمت ىتش لسثى للارءزلاى عملا ثل مش ابشث لشث ش شعثل ', 'event_2.png'),
(4, '2018-04-19', 'Student Festival', 'Grand Central Park', 'In aliquam, augue a gravida rutrum, ante nisl fermentum nulla, vitae tempor nisl ligula vel nunc. Proin quis mi malesuada, finibus tortor. vitae tempor nisl ligula vel nunc. Proin quis mi malesuada, finibus tortor.  vitae tempor nisl ligula vel nunc. Proin quis mi malesuada, finibus tortor. vitae tempor nisl ligula vel nunc. Proin quis mi malesuada, finibus tortor.', '', '', '', 'event_4.png'),
(5, '2018-04-28', 'ed el om', '', '', 'عيد الام', 'وايت هاوس', 'يسثلس سملثسل ثسى س ىثسا ثسىتسى سم مستاهث مهسن سثىاس مثسنثتهسثا مس ثسهتا ل', 'event_5.png');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE IF NOT EXISTS `instructor` (
`instructorID` int(7) NOT NULL,
  `instructorName` varchar(255) NOT NULL,
  `instructorNameAr` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `IDNumber` varchar(16) NOT NULL,
  `birthDate` date NOT NULL,
  `degrees` varchar(255) NOT NULL,
  `degreesAr` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`instructorID`, `instructorName`, `instructorNameAr`, `email`, `phone`, `IDNumber`, `birthDate`, `degrees`, `degreesAr`, `image`) VALUES
(1, 'ayman', ' ايمن الصباغ', 'ayman@hotmail.com', '', '', '0000-00-00', 'Doctor in English language', 'دكتور اللغة الانجليزيه ', 'instructor_1.png');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
`ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `read` tinyint(4) NOT NULL DEFAULT '0',
  `appear` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`ID`, `name`, `email`, `message`, `read`, `appear`) VALUES
(4, 'essam', 'essam@gmail.com', 'afafawf', 1, 1),
(5, 'ali', '', 'sgaojaa ijagjaegnaievjakk aejgekngana agjagjawpgja agagoawko akaw', 1, 1),
(6, 'Essam Abozaid', 'essamabozaid12@gmail.com', 'a7la white house de wla eh', 1, 1),
(7, 'sa', 'essamabozaid1@gmail.com', 'efaega', 1, 0),
(8, 'Essam Abozaid', 'essamabozaid12@gmail.com', 'ana far7', 1, 0),
(9, '', 'essamabozaid2@gmail.com', '', 0, 0),
(10, '', 'eessamabozaid1@gmail.com', '', 0, 0),
(11, '', 'essamabozaid122@gmail.com', '', 0, 0),
(12, '', 'essamabozaid12222@gmail.com', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`ID` int(11) NOT NULL,
  `Header` varchar(255) NOT NULL,
  `SubPara` text NOT NULL,
  `FullPara` text NOT NULL,
  `HeaderAr` varchar(255) NOT NULL,
  `SubParaAr` text NOT NULL,
  `FullParaAr` text NOT NULL,
  `NewsDate` date NOT NULL,
  `mainImage` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`ID`, `Header`, `SubPara`, `FullPara`, `HeaderAr`, `SubParaAr`, `FullParaAr`, `NewsDate`, `mainImage`) VALUES
(1, 'Essam', 'svsvv', 'evsvesveavamvaovm', 'لماذا تحتاج التاهيل؟؟؟؟؟؟؟', 'سشبشص شتشت ش بش ', 'رشر شر شترش رشصه ', '2018-04-10', 'news_1.png'),
(2, 'Why do you need a qualification?', 'In aliquam, augue a gravida rutrum, ante nisl fermentum nulla, vitae tempor nisl ligula vel nunc. Proin quis mi malesuada, finibus tortor fermentum. Etiam eu purus nec eros varius luctus. Praesent finibus risus facilisis ultricies.', 'In aliquam, augue a gravida rutrum, ante nisl fermentum nulla, vitae tempor nisl ligula vel nunc. Proin quis mi malesuada, finibus tortor fermentum. Etiam eu purus nec eros varius luctus. Praesent finibus risus facilisis ultricies.In aliquam, augue a gravida rutrum, ante nisl fermentum nulla, vitae tempor nisl ligula vel nunc. Proin quis mi malesuada, finibus tortor fermentum. Etiam eu purus nec eros varius luctus. Praesent finibus risus facilisis ultricies.In aliquam, augue a gravida rutrum, ante nisl fermentum nulla, vitae tempor nisl ligula vel nunc. Proin quis mi malesuada, finibus tortor fermentum. Etiam eu purus nec eros varius luctus. Praesent finibus risus facilisis ultricies.In aliquam, augue a gravida rutrum, ante nisl fermentum nulla, vitae tempor nisl ligula vel nunc. Proin quis mi malesuada, finibus tortor fermentum. Etiam eu purus nec eros varius luctus. Praesent finibus risus facilisis ultricies.In aliquam, augue a gravida rutrum, ante nisl fermentum nulla, vitae tempor nisl ligula vel nunc. Proin quis mi malesuada, finibus tortor fermentum. Etiam eu purus nec eros varius luctus. Praesent finibus risus facilisis ultricies.In aliquam, augue a gravida rutrum, ante nisl fermentum nulla, vitae tempor nisl ligula vel nunc. Proin quis mi malesuada, finibus tortor fermentum. Etiam eu purus nec eros varius luctus. Praesent finibus risus facilisis ultricies.In aliquam, augue a gravida rutrum, ante nisl fermentum nulla, vitae tempor nisl ligula vel nunc. Proin quis mi malesuada, finibus tortor fermentum. Etiam eu purus nec eros varius luctus. Praesent finibus risus facilisis ultricies.In aliquam, augue a gravida rutrum, ante nisl fermentum nulla, vitae tempor nisl ligula vel nunc. Proin quis mi malesuada, finibus tortor fermentum. Etiam eu purus nec eros varius luctus. Praesent finibus risus facilisis ultricies.In aliquam, augue a gravida rutrum, ante nisl fermentum nulla, vitae tempor nisl ligula vel nunc. Proin quis mi malesuada, finibus tortor fermentum. Etiam eu purus nec eros varius luctus. Praesent finibus risus facilisis ultricies.In aliquam, augue a gravida rutrum, ante nisl fermentum nulla, vitae tempor nisl ligula vel nunc. Proin quis mi malesuada, finibus tortor fermentum. Etiam eu purus nec eros varius luctus. Praesent finibus risus facilisis ultricies.', 'حريق #المتحف_المصرى قبل افتتاجه وحريق جديد بماسبيرو!!', 'بمناسبة النجمة الرابعة ڤودافون بتحتفل مع جماهير النادي الأهلي ب٤٠ دقيقة هدية لأرقام ڤودافون من عالم النادي الأهلي. كلم #١* و اشترك علشان تستمتع بالعرض و كمان ممكن تخلي اغنية "انا الأهلي" كول تونك!', 'بمناسبة النجمة الرابعة ڤودافون بتحتفل مع جماهير النادي الأهلي ب٤٠ دقيقة هدية لأرقام ڤودافون من عالم النادي الأهلي. كلم #١* و اشترك علشان تستمتع بالعرض و كمان ممكن تخلي اغنية "انا الأهلي" كول تونك!\r\nبمناسبة النجمة الرابعة ڤودافون بتحتفل مع جماهير النادي الأهلي ب٤٠ دقيقة هدية لأرقام ڤودافون من عالم النادي الأهلي. كلم #١* و اشترك علشان تستمتع بالعرض و كمان ممكن تخلي اغنية "انا الأهلي" كول تونك!\r\nبمناسبة النجمة الرابعة ڤودافون بتحتفل مع جماهير النادي الأهلي ب٤٠ دقيقة هدية لأرقام ڤودافون من عالم النادي الأهلي. كلم #١* و اشترك علشان تستمتع بالعرض و كمان ممكن تخلي اغنية "انا الأهلي" كول تونك!\r\nبمناسبة النجمة الرابعة ڤودافون بتحتفل مع جماهير النادي الأهلي ب٤٠ دقيقة هدية لأرقام ڤودافون من عالم النادي الأهلي. كلم #١* و اشترك علشان تستمتع بالعرض و كمان ممكن تخلي اغنية "انا الأهلي" كول تونك!\r\nبمناسبة النجمة الرابعة ڤودافون بتحتفل مع جماهير النادي الأهلي ب٤٠ دقيقة هدية لأرقام ڤودافون من عالم النادي الأهلي. كلم #١* و اشترك علشان تستمتع بالعرض و كمان ممكن تخلي اغنية "انا الأهلي" كول تونك!\r\nبمناسبة النجمة الرابعة ڤودافون بتحتفل مع جماهير النادي الأهلي ب٤٠ دقيقة هدية لأرقام ڤودافون من عالم النادي الأهلي. كلم #١* و اشترك علشان تستمتع بالعرض و كمان ممكن تخلي اغنية "انا الأهلي" كول تونك!\r\nبمناسبة النجمة الرابعة ڤودافون بتحتفل مع جماهير النادي الأهلي ب٤٠ دقيقة هدية لأرقام ڤودافون من عالم النادي الأهلي. كلم #١* و اشترك علشان تستمتع بالعرض و كمان ممكن تخلي اغنية "انا الأهلي" كول تونك!\r\nبمناسبة النجمة الرابعة ڤودافون بتحتفل مع جماهير النادي الأهلي ب٤٠ دقيقة هدية لأرقام ڤودافون من عالم النادي الأهلي. كلم #١* و اشترك علشان تستمتع بالعرض و كمان ممكن تخلي اغنية "انا الأهلي" كول تونك!\r\nبمناسبة النجمة الرابعة ڤودافون بتحتفل مع جماهير النادي الأهلي ب٤٠ دقيقة هدية لأرقام ڤودافون من عالم النادي الأهلي. كلم #١* و اشترك علشان تستمتع بالعرض و كمان ممكن تخلي اغنية "انا الأهلي" كول تونك!\r\nبمناسبة النجمة الرابعة ڤودافون بتحتفل مع جماهير النادي الأهلي ب٤٠ دقيقة هدية لأرقام ڤودافون من عالم النادي الأهلي. كلم #١* و اشترك علشان تستمتع بالعرض و كمان ممكن تخلي اغنية "انا الأهلي" كول تونك!\r\nبمناسبة النجمة الرابعة ڤودافون بتحتفل مع جماهير النادي الأهلي ب٤٠ دقيقة هدية لأرقام ڤودافون من عالم النادي الأهلي. كلم #١* و اشترك علشان تستمتع بالعرض و كمان ممكن تخلي اغنية "انا الأهلي" كول تونك!\r\nبمناسبة النجمة الرابعة ڤودافون بتحتفل مع جماهير النادي الأهلي ب٤٠ دقيقة هدية لأرقام ڤودافون من عالم النادي الأهلي. كلم #١* و اشترك علشان تستمتع بالعرض و كمان ممكن تخلي اغنية "انا الأهلي" كول تونك!', '2018-04-21', 'news_2.png');

-- --------------------------------------------------------

--
-- Table structure for table `newsimages`
--

CREATE TABLE IF NOT EXISTS `newsimages` (
`ID` int(11) NOT NULL,
  `imageName` varchar(255) NOT NULL,
  `newsID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `newsimages`
--

INSERT INTO `newsimages` (`ID`, `imageName`, `newsID`) VALUES
(1, 'imageNews_5ae6d14e36918.png', 1),
(2, 'imageNews_5ae6d14e3f738.png', 1),
(4, 'imageNews_5ae6d14e631f1.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `advertise`
--
ALTER TABLE `advertise`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `career`
--
ALTER TABLE `career`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
 ADD PRIMARY KEY (`SlideID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`categoryID`), ADD UNIQUE KEY `catName` (`catName`);

--
-- Indexes for table `certification`
--
ALTER TABLE `certification`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
 ADD PRIMARY KEY (`clientID`), ADD UNIQUE KEY `userName` (`userName`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
 ADD PRIMARY KEY (`courseID`), ADD UNIQUE KEY `unique_index` (`courseName`,`catID`), ADD KEY `Course_Cat` (`catID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
 ADD PRIMARY KEY (`instructorID`), ADD UNIQUE KEY `instructorName` (`instructorName`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `newsimages`
--
ALTER TABLE `newsimages`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `imageName` (`imageName`), ADD KEY `newsID` (`newsID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `career`
--
ALTER TABLE `career`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
MODIFY `SlideID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
MODIFY `clientID` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
MODIFY `courseID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
MODIFY `instructorID` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `newsimages`
--
ALTER TABLE `newsimages`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
ADD CONSTRAINT `Course_Cat` FOREIGN KEY (`catID`) REFERENCES `category` (`categoryID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `newsimages`
--
ALTER TABLE `newsimages`
ADD CONSTRAINT `FK_newsImages` FOREIGN KEY (`newsID`) REFERENCES `news` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
