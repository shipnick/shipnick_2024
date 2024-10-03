-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 03, 2024 at 01:57 PM
-- Server version: 5.7.23-23
-- PHP Version: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
use shipnick_db;
START TRANSACTION;
SET time_zone = "+00:00";



/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prosacgj_shipnick`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `spid` int(11) DEFAULT NULL,
  `crtuid` int(11) DEFAULT NULL,
  `usertype` varchar(100) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `profilepic` varchar(250) DEFAULT NULL,
  `companyname` varchar(150) DEFAULT NULL,
  `brandame` varchar(150) DEFAULT NULL,
  `remmitanceday` varchar(150) DEFAULT NULL,
  `maxcodvalue` varchar(50) DEFAULT NULL,
  `maxliablilitshipment` varchar(50) DEFAULT NULL,
  `actype` varchar(50) DEFAULT NULL,
  `freighttype` varchar(50) DEFAULT NULL,
  `address1` varchar(150) DEFAULT NULL,
  `address2` varchar(150) DEFAULT NULL,
  `pincode` bigint(20) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `gstno` varchar(25) DEFAULT NULL,
  `panno` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `report_show` int(11) DEFAULT '0',
  `report_mis_show` int(11) DEFAULT '0',
  `report_pod_show` int(11) DEFAULT '0',
  `report_rpod_show` int(11) DEFAULT '0',
  `report_daily_show` int(11) DEFAULT '0',
  `billing_show` int(11) DEFAULT '0',
  `billing_all_show` int(11) DEFAULT '0',
  `billing_download_show` int(11) DEFAULT '0',
  `wallet_show` int(11) DEFAULT '0',
  `wallet_add_show` int(11) DEFAULT '0',
  `wallet_details_show` int(11) DEFAULT '0',
  `pincode_show` int(11) DEFAULT '0',
  `ndr_show` int(11) DEFAULT '0',
  `print_ship_labels` int(11) DEFAULT '0',
  `rider_show` int(11) DEFAULT '0',
  `Intargos` int(11) DEFAULT NULL,
  `Nimbus` int(11) DEFAULT NULL,
  `EcomExpress` int(11) DEFAULT NULL,
  `Shadowfax` int(11) DEFAULT NULL,
  `Intargos1` int(11) DEFAULT NULL,
  `intargos_active` int(11) DEFAULT NULL,
  `nimbus_active` int(11) DEFAULT NULL,
  `Pickrr` int(11) DEFAULT '0',
  `BigShip` int(11) DEFAULT '0',
  `SmartShip` int(11) DEFAULT '0',
  `Shiprocket` int(11) DEFAULT NULL,
  `Xpressbees` int(11) DEFAULT NULL,
  `Xpressbees2` int(11) DEFAULT NULL,
  `Xpressbees3` int(11) DEFAULT NULL,
  `bluedart` varchar(50) DEFAULT NULL,
  `Bluedart-sc` int(11) DEFAULT NULL,
  `Parclex` int(11) DEFAULT NULL,
  `api_priority_XpressBee` int(11) DEFAULT '0',
  `api_priority_Pickrr` int(11) DEFAULT '0',
  `api_priority_BigShip` int(11) DEFAULT '0',
  `api_priority_SmartShip` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_billing`
--

CREATE TABLE `admin_billing` (
  `adbid` bigint(20) NOT NULL,
  `adminid` bigint(20) DEFAULT NULL,
  `billaddress` varchar(150) DEFAULT NULL,
  `billcity` varchar(50) DEFAULT NULL,
  `billstate` varchar(50) DEFAULT NULL,
  `billpincode` bigint(20) DEFAULT NULL,
  `billcreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `billupdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_couriers`
--

CREATE TABLE `admin_couriers` (
  `courierid` bigint(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `courier_added` varchar(100) NOT NULL,
  `cou_code` varchar(5) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `logo` varchar(150) DEFAULT NULL,
  `bereartoken` varchar(250) DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fbupto` varchar(50) DEFAULT NULL,
  `fbwithcity` float DEFAULT NULL,
  `fbwithstate` float DEFAULT NULL,
  `fbwithzone` float DEFAULT NULL,
  `fbmtetrotometro` float DEFAULT NULL,
  `fbrestofindia` float DEFAULT NULL,
  `fbextralocation` float DEFAULT NULL,
  `fbspecaildestination` float DEFAULT NULL,
  `fbcodcharge` float DEFAULT NULL,
  `fbcodchargepersent` float DEFAULT NULL,
  `faupto` varchar(50) DEFAULT NULL,
  `fawithcity` float DEFAULT NULL,
  `fawithstate` float DEFAULT NULL,
  `fawihtzone` float DEFAULT NULL,
  `fametrotometro` float DEFAULT NULL,
  `faresttoindia` float DEFAULT NULL,
  `faextralocation` float DEFAULT NULL,
  `faspecialdestination` float DEFAULT NULL,
  `facodcharge` float DEFAULT NULL,
  `facodchargepersent` float DEFAULT NULL,
  `rbupto` varchar(50) DEFAULT NULL,
  `rpwihtcity` float DEFAULT NULL,
  `rbwithstate` float DEFAULT NULL,
  `rbwithzone` float DEFAULT NULL,
  `rbmetrotometro` float DEFAULT NULL,
  `rbresttoindia` float DEFAULT NULL,
  `rbextralocation` float DEFAULT NULL,
  `rbspeciladestination` float DEFAULT NULL,
  `rbcodcharge` float DEFAULT NULL,
  `rbcodchargepersent` float DEFAULT NULL,
  `raupto` varchar(50) DEFAULT NULL,
  `rawithcity` float DEFAULT NULL,
  `rawithstate` float DEFAULT NULL,
  `rawithzone` float DEFAULT NULL,
  `rametrotometro` float DEFAULT NULL,
  `raresttoindia` float DEFAULT NULL,
  `raextralocation` float DEFAULT NULL,
  `raspecialdestination` float DEFAULT NULL,
  `racodcharge` float DEFAULT NULL,
  `racodchargepersent` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin_financial`
--

CREATE TABLE `admin_financial` (
  `afid` bigint(20) NOT NULL,
  `adminid` bigint(20) DEFAULT NULL,
  `bankbenificiaryname` varchar(150) DEFAULT NULL,
  `bankname` varchar(150) DEFAULT NULL,
  `bankacno` varchar(50) DEFAULT NULL,
  `bankifsc` varchar(50) DEFAULT NULL,
  `bankbranch` varchar(150) DEFAULT NULL,
  `bankactype` varchar(50) DEFAULT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bulk_pincodes`
--

CREATE TABLE `bulk_pincodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `folder_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_variables`
--

CREATE TABLE `client_variables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courier_list`
--

CREATE TABLE `courier_list` (
  `cl_pid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `courier_code` varchar(10) NOT NULL,
  `cl_name` varchar(50) NOT NULL,
  `courier_by` varchar(20) NOT NULL,
  `cl_id` varchar(20) NOT NULL,
  `active_flg` int(11) NOT NULL,
  `display_courier_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courier_permission`
--

CREATE TABLE `courier_permission` (
  `cp_id` int(11) NOT NULL,
  `courier_idno` varchar(100) NOT NULL,
  `courier_code` varchar(5) NOT NULL,
  `courier_by` varchar(25) NOT NULL,
  `courier_priority` int(11) DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `admin_flg` int(11) NOT NULL,
  `user_flg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hub_address`
--

CREATE TABLE `hub_address` (
  `hub_id` int(11) NOT NULL,
  `hub_created_by` bigint(20) DEFAULT NULL,
  `intargos_added` int(11) NOT NULL DEFAULT '2',
  `intargos_updated` int(11) NOT NULL DEFAULT '1',
  `hub_alternate_id` varchar(250) DEFAULT NULL,
  `hub_code` varchar(20) DEFAULT NULL,
  `nimbus_hubid` varchar(20) DEFAULT NULL,
  `intargos_hubid` varchar(20) DEFAULT NULL,
  `hub_title` varchar(50) NOT NULL DEFAULT '',
  `hub_name` varchar(250) DEFAULT NULL,
  `hub_gstno` varchar(250) DEFAULT NULL,
  `hub_address1` varchar(250) DEFAULT NULL,
  `hub_address2` varchar(250) DEFAULT NULL,
  `hub_mobile` varchar(20) DEFAULT NULL,
  `hub_pincode` varchar(20) DEFAULT NULL,
  `hub_state` varchar(250) DEFAULT NULL,
  `hub_city` varchar(250) DEFAULT NULL,
  `hub_deliverytype` varchar(250) DEFAULT NULL,
  `hub_folder` varchar(250) DEFAULT NULL,
  `hub_img` varchar(250) DEFAULT NULL,
  `smartship_hubid` varchar(150) DEFAULT NULL,
  `Shiprocket_hub_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manifestreport`
--

CREATE TABLE `manifestreport` (
  `manifest_id` bigint(20) NOT NULL,
  `hub_name` varchar(250) DEFAULT NULL,
  `hub_id` bigint(20) DEFAULT NULL,
  `customer_name` varchar(250) DEFAULT NULL,
  `courier_name` varchar(250) DEFAULT NULL,
  `dispatch_name` varchar(250) DEFAULT NULL,
  `total_shipment` varchar(250) DEFAULT NULL,
  `manifest_type` varchar(250) DEFAULT NULL,
  `notes` varchar(250) DEFAULT NULL,
  `awb_no` varchar(250) DEFAULT NULL,
  `order_id` varchar(250) DEFAULT NULL,
  `tracking_id` varchar(250) DEFAULT NULL,
  `cname` varchar(250) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mis_report`
--

CREATE TABLE `mis_report` (
  `id` int(11) NOT NULL,
  `order_id` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `awb_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_scanned_at` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_scan_remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_attempts` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_attempt_on` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `second_attempt_on` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `third_attempt_on` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_attempt_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `turn_around_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `forward_charges` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `rto_charges` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `cod_charges` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `fov_charges` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `fsc_charges` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `reverse_charges` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `surcharge 2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `surcharge 3` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ndr_charges` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `awb_Charges` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `charges_total` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `GST Charges` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `onlinecourierapidetails`
--

CREATE TABLE `onlinecourierapidetails` (
  `apidetailsid` int(11) NOT NULL,
  `courier_id` varchar(250) DEFAULT NULL,
  `courier_name` varchar(100) DEFAULT NULL,
  `item_orderno` varchar(250) DEFAULT NULL,
  `success` varchar(250) DEFAULT NULL,
  `order_id` varchar(250) DEFAULT NULL,
  `order_pk` varchar(250) DEFAULT NULL,
  `awb_tracking_id` varchar(250) DEFAULT NULL,
  `manifest_link` varchar(250) DEFAULT NULL,
  `routing_code` varchar(250) DEFAULT NULL,
  `client_order_id` varchar(250) DEFAULT NULL,
  `courier_by` varchar(250) DEFAULT NULL,
  `dispatch_mode` varchar(250) DEFAULT NULL,
  `child_waybill_list` varchar(250) DEFAULT NULL,
  `ip_string` varchar(250) DEFAULT NULL,
  `manifest_link_pdf` varchar(250) DEFAULT NULL,
  `manifest_img_link` varchar(250) DEFAULT NULL,
  `received_by` varchar(250) DEFAULT NULL,
  `current_status_type` varchar(250) DEFAULT NULL,
  `current_status_body` varchar(250) DEFAULT NULL,
  `current_status_location` varchar(250) DEFAULT NULL,
  `current_status_time` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `onlinecourierapis`
--

CREATE TABLE `onlinecourierapis` (
  `courier_id` int(11) NOT NULL,
  `courier_name` varchar(250) DEFAULT NULL,
  `courier_name_show` varchar(100) DEFAULT NULL,
  `courier_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `onlineordersprod`
--

CREATE TABLE `onlineordersprod` (
  `orederprod_id` int(11) NOT NULL,
  `orederprod_master` varchar(250) DEFAULT NULL,
  `orederprod_name` varchar(250) DEFAULT NULL,
  `orederprod_cost` float DEFAULT NULL,
  `orederprod_qlty` int(11) DEFAULT NULL,
  `orederprod_total` float DEFAULT NULL,
  `orederprod_status` varchar(100) DEFAULT NULL,
  `order_no` varchar(100) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderid` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `awb_no` varchar(100) DEFAULT NULL,
  `transaction` varchar(250) DEFAULT NULL,
  `debit` int(11) DEFAULT NULL,
  `credit` varchar(220) DEFAULT NULL,
  `close_blance` varchar(250) DEFAULT NULL,
  `applied_wet` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `date` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail_user`
--

CREATE TABLE `orderdetail_user` (
  `useru_id` int(11) NOT NULL,
  `orderno` varchar(100) DEFAULT NULL,
  `cname` varchar(250) DEFAULT NULL,
  `caddress` varchar(500) DEFAULT NULL,
  `cstate` varchar(250) DEFAULT NULL,
  `ccity` varchar(250) DEFAULT NULL,
  `cmobile` bigint(20) DEFAULT NULL,
  `cpin` bigint(20) DEFAULT NULL,
  `pweight` float DEFAULT NULL,
  `ptamt` float DEFAULT NULL,
  `itemname` varchar(500) DEFAULT NULL,
  `itemquantity` int(11) DEFAULT NULL,
  `itmecodamt` varchar(200) DEFAULT NULL,
  `iteminvoicevalue` varchar(200) DEFAULT NULL,
  `additionaldetails` varchar(200) DEFAULT NULL,
  `orderdate` date DEFAULT NULL,
  `orderdtime` time DEFAULT NULL,
  `orderdatetime` datetime DEFAULT NULL,
  `order_status` varchar(250) DEFAULT NULL,
  `order_userid` int(11) DEFAULT NULL,
  `order_riderid` int(11) DEFAULT NULL,
  `order_ridername` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderstatus_labels`
--

CREATE TABLE `orderstatus_labels` (
  `labelid` int(11) NOT NULL,
  `labelname` varchar(250) DEFAULT NULL,
  `labelcate` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderupdateawbs`
--

CREATE TABLE `orderupdateawbs` (
  `autoupdateid` bigint(20) NOT NULL,
  `awbno` varchar(50) NOT NULL DEFAULT '0',
  `courier_ship_no` varchar(20) DEFAULT NULL,
  `courier_company` varchar(20) DEFAULT NULL,
  `hitornot` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_id` varchar(220) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `r_payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pickrr_status_code`
--

CREATE TABLE `pickrr_status_code` (
  `pickrr_status_id` int(11) NOT NULL,
  `short_form` varchar(250) DEFAULT NULL,
  `full_form` varchar(250) DEFAULT NULL,
  `courier_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pincodes`
--

CREATE TABLE `pincodes` (
  `id` int(11) NOT NULL,
  `pincode` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `zone` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city_type` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pincode_files`
--

CREATE TABLE `pincode_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `folder_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_count` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pricing`
--

CREATE TABLE `pricing` (
  `id` int(11) NOT NULL,
  `courier_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fwda` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fwdb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fwdc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fwdd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fwde` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fwdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fwdg` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fwdh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rtoa` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rtob` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rtoc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rtod` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rtoe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rtof` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wtb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wtc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wtd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wte` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wtf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_id` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shippind_labels`
--

CREATE TABLE `shippind_labels` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Consignee_Number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rtoAddress` text COLLATE utf8_unicode_ci,
  `order_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Products_Details` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Return_Address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Weight` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Dimensions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Support_Mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Support_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supportnumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supportemail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `smartships`
--

CREATE TABLE `smartships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expire_in` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spark_mis_report`
--

CREATE TABLE `spark_mis_report` (
  `mis_id` bigint(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_name` varchar(250) DEFAULT NULL,
  `awbno` varchar(250) DEFAULT NULL,
  `orderno` varchar(250) DEFAULT NULL,
  `pickupdate` date DEFAULT NULL,
  `pickuptime` time DEFAULT NULL,
  `orderstatus` varchar(250) DEFAULT NULL,
  `courierremark` varchar(250) DEFAULT NULL,
  `laststatusdate` date DEFAULT NULL,
  `laststatustime` time DEFAULT NULL,
  `deliverydate` date DEFAULT NULL,
  `firstscandate` date DEFAULT NULL,
  `firstscantime` time DEFAULT NULL,
  `firstattemptdate` date DEFAULT NULL,
  `edd` date DEFAULT NULL,
  `origincity` varchar(250) DEFAULT NULL,
  `originpincode` varchar(250) DEFAULT NULL,
  `destinationcity` varchar(250) DEFAULT NULL,
  `destinationpincode` varchar(250) DEFAULT NULL,
  `customername` varchar(250) DEFAULT NULL,
  `customercontact` varchar(250) DEFAULT NULL,
  `clientname` varchar(250) DEFAULT NULL,
  `paymentmode` varchar(250) DEFAULT NULL,
  `codamt` varchar(250) DEFAULT NULL,
  `orderageing` varchar(250) DEFAULT NULL,
  `attemptcount` varchar(250) DEFAULT NULL,
  `couriername` varchar(250) DEFAULT NULL,
  `rtodate` date DEFAULT NULL,
  `rtoreason` varchar(250) DEFAULT NULL,
  `zonename` varchar(250) DEFAULT NULL,
  `lastofddate` date DEFAULT NULL,
  `ndrinstructions` varchar(250) DEFAULT NULL,
  `uploadtimestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `uploaddate` date DEFAULT NULL,
  `uploadtime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spark_ndr_report`
--

CREATE TABLE `spark_ndr_report` (
  `mis_id` bigint(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_name` varchar(250) DEFAULT NULL,
  `awbno` varchar(250) DEFAULT NULL,
  `orderno` varchar(250) DEFAULT NULL,
  `pickupdate` date DEFAULT NULL,
  `pickuptime` time DEFAULT NULL,
  `orderstatus` varchar(250) DEFAULT NULL,
  `courierremark` varchar(250) DEFAULT NULL,
  `laststatusdate` date DEFAULT NULL,
  `laststatustime` time DEFAULT NULL,
  `deliverydate` date DEFAULT NULL,
  `firstscandate` date DEFAULT NULL,
  `firstscantime` time DEFAULT NULL,
  `firstattemptdate` date DEFAULT NULL,
  `edd` date DEFAULT NULL,
  `origincity` varchar(250) DEFAULT NULL,
  `originpincode` varchar(250) DEFAULT NULL,
  `destinationcity` varchar(250) DEFAULT NULL,
  `destinationpincode` varchar(250) DEFAULT NULL,
  `customername` varchar(250) DEFAULT NULL,
  `customercontact` varchar(250) DEFAULT NULL,
  `clientname` varchar(250) DEFAULT NULL,
  `paymentmode` varchar(250) DEFAULT NULL,
  `codamt` varchar(250) DEFAULT NULL,
  `orderageing` varchar(250) DEFAULT NULL,
  `attemptcount` varchar(250) DEFAULT NULL,
  `couriername` varchar(250) DEFAULT NULL,
  `rtodate` date DEFAULT NULL,
  `rtoreason` varchar(250) DEFAULT NULL,
  `zonename` varchar(250) DEFAULT NULL,
  `lastofddate` date DEFAULT NULL,
  `ndrinstructions` varchar(250) DEFAULT NULL,
  `uploadtimestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `uploaddate` date DEFAULT NULL,
  `uploadtime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spark_single_order`
--

CREATE TABLE `spark_single_order` (
  `Single_Order_Id` bigint(11) NOT NULL,
  `Order_Type` varchar(200) DEFAULT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `orderno` varchar(250) DEFAULT NULL,
  `ordernoapi` varchar(250) DEFAULT NULL,
  `courier_ship_no` varchar(20) NOT NULL DEFAULT '',
  `Awb_Number` varchar(300) NOT NULL DEFAULT '',
  `awb_gen_by` varchar(150) DEFAULT NULL,
  `awb_gen_courier` varchar(20) NOT NULL DEFAULT '',
  `Name` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `State` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `City` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Mobile` varchar(100) DEFAULT NULL,
  `mobile_no2` varchar(20) DEFAULT NULL,
  `order_email` varchar(250) DEFAULT NULL,
  `Pincode` varchar(20) DEFAULT NULL,
  `Item_Name` varchar(300) DEFAULT NULL,
  `sku` text,
  `Quantity` int(11) DEFAULT NULL,
  `Width` varchar(100) DEFAULT NULL,
  `Height` varchar(100) DEFAULT NULL,
  `Length` varchar(100) DEFAULT NULL,
  `Actual_Weight` float DEFAULT NULL,
  `volumetric_weight` float DEFAULT NULL,
  `Total_Amount` float DEFAULT NULL,
  `Invoice_Value` float DEFAULT NULL,
  `Cod_Amount` float DEFAULT NULL,
  `zonename` varchar(10) NOT NULL DEFAULT '',
  `Clinet_Order_Id` varchar(200) DEFAULT NULL,
  `additionaltype` varchar(250) DEFAULT NULL,
  `Rec_Time_Stamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `Rec_Time_Date` date DEFAULT NULL,
  `Last_Time_Stamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `Last_Stamp_Date` date DEFAULT NULL,
  `pickupdate` date DEFAULT NULL,
  `pickupdatetime` datetime DEFAULT NULL,
  `delivereddate` date DEFAULT NULL,
  `delivereddatetime` datetime DEFAULT NULL,
  `rtodate` date DEFAULT NULL,
  `rtodatetime` datetime DEFAULT NULL,
  `canceldate` date DEFAULT NULL,
  `canceldatetime` datetime DEFAULT NULL,
  `uploadtype` varchar(100) DEFAULT NULL,
  `Active` tinyint(4) NOT NULL DEFAULT '1',
  `order_status` varchar(250) DEFAULT NULL,
  `order_status1` varchar(250) DEFAULT NULL,
  `order_status_show` varchar(250) DEFAULT NULL,
  `pickup_id` varchar(250) DEFAULT NULL,
  `Address_Id` varchar(50) DEFAULT NULL,
  `pickup_name` varchar(250) DEFAULT NULL,
  `pickup_mobile` varchar(130) DEFAULT NULL,
  `pickup_pincode` varchar(20) DEFAULT NULL,
  `pickup_gstin` varchar(100) DEFAULT NULL,
  `pickup_address` varchar(400) DEFAULT NULL,
  `pickup_state` varchar(100) DEFAULT NULL,
  `pickup_city` varchar(100) DEFAULT NULL,
  `order_cancel` varchar(11) DEFAULT '',
  `order_cancel_reasion` varchar(250) DEFAULT NULL,
  `xberrors` varchar(800) DEFAULT NULL,
  `dhlerrors` varchar(800) DEFAULT NULL,
  `shferrors` varchar(800) DEFAULT NULL,
  `dtdcerrors` varchar(800) DEFAULT NULL,
  `showerrors` varchar(800) DEFAULT NULL,
  `apihitornot` int(11) NOT NULL DEFAULT '0',
  `Address2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `zone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spark_single_order_file`
--

CREATE TABLE `spark_single_order_file` (
  `sparkorderid` int(11) NOT NULL,
  `foldername` varchar(250) DEFAULT NULL,
  `filename` varchar(250) DEFAULT NULL,
  `uploaddate` date DEFAULT NULL,
  `uploadtime` time DEFAULT NULL,
  `uploaddatetime` datetime DEFAULT NULL,
  `uploadby` varchar(250) DEFAULT NULL,
  `uploadid` varchar(250) DEFAULT NULL,
  `uploadusercate` varchar(250) DEFAULT NULL,
  `totalnooforders` varchar(250) DEFAULT NULL,
  `apihitornot` int(11) DEFAULT '1',
  `startingpoint` int(11) DEFAULT NULL,
  `endingpoint` int(11) DEFAULT NULL,
  `nextstartpoint` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `usertype` varchar(100) DEFAULT NULL,
  `spid` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `profilepic` varchar(250) DEFAULT NULL,
  `companyname` varchar(150) DEFAULT NULL,
  `brandame` varchar(150) DEFAULT NULL,
  `remmitanceday` varchar(150) DEFAULT NULL,
  `maxcodvalue` varchar(50) DEFAULT NULL,
  `maxliablilitshipment` varchar(50) DEFAULT NULL,
  `actype` varchar(50) DEFAULT NULL,
  `freighttype` varchar(50) DEFAULT NULL,
  `address1` varchar(150) DEFAULT NULL,
  `address2` varchar(150) DEFAULT NULL,
  `pincode` bigint(20) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `gstno` varchar(25) DEFAULT NULL,
  `panno` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `report_show` int(11) DEFAULT '0',
  `report_mis_show` int(11) DEFAULT '0',
  `report_pod_show` int(11) DEFAULT '0',
  `report_rpod_show` int(11) DEFAULT '0',
  `report_daily_show` int(11) DEFAULT '0',
  `billing_show` int(11) DEFAULT '0',
  `billing_all_show` int(11) DEFAULT '0',
  `billing_download_show` int(11) DEFAULT '0',
  `wallet_show` int(11) DEFAULT '0',
  `wallet_add_show` int(11) DEFAULT '0',
  `wallet_details_show` int(11) DEFAULT '0',
  `pincode_show` int(11) DEFAULT '0',
  `ndr_show` int(11) DEFAULT '0',
  `print_ship_labels` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_billing`
--
ALTER TABLE `admin_billing`
  ADD PRIMARY KEY (`adbid`);

--
-- Indexes for table `admin_couriers`
--
ALTER TABLE `admin_couriers`
  ADD PRIMARY KEY (`courierid`);

--
-- Indexes for table `admin_financial`
--
ALTER TABLE `admin_financial`
  ADD PRIMARY KEY (`afid`);

--
-- Indexes for table `bulk_pincodes`
--
ALTER TABLE `bulk_pincodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `client_variables`
--
ALTER TABLE `client_variables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courier_list`
--
ALTER TABLE `courier_list`
  ADD PRIMARY KEY (`cl_pid`);

--
-- Indexes for table `courier_permission`
--
ALTER TABLE `courier_permission`
  ADD PRIMARY KEY (`cp_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hub_address`
--
ALTER TABLE `hub_address`
  ADD PRIMARY KEY (`hub_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `manifestreport`
--
ALTER TABLE `manifestreport`
  ADD PRIMARY KEY (`manifest_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mis_report`
--
ALTER TABLE `mis_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onlinecourierapidetails`
--
ALTER TABLE `onlinecourierapidetails`
  ADD PRIMARY KEY (`apidetailsid`);

--
-- Indexes for table `onlinecourierapis`
--
ALTER TABLE `onlinecourierapis`
  ADD PRIMARY KEY (`courier_id`);

--
-- Indexes for table `onlineordersprod`
--
ALTER TABLE `onlineordersprod`
  ADD PRIMARY KEY (`orederprod_id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `orderdetail_user`
--
ALTER TABLE `orderdetail_user`
  ADD PRIMARY KEY (`useru_id`);

--
-- Indexes for table `orderstatus_labels`
--
ALTER TABLE `orderstatus_labels`
  ADD PRIMARY KEY (`labelid`);

--
-- Indexes for table `orderupdateawbs`
--
ALTER TABLE `orderupdateawbs`
  ADD PRIMARY KEY (`autoupdateid`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pickrr_status_code`
--
ALTER TABLE `pickrr_status_code`
  ADD PRIMARY KEY (`pickrr_status_id`);

--
-- Indexes for table `pincodes`
--
ALTER TABLE `pincodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pincode_files`
--
ALTER TABLE `pincode_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricing`
--
ALTER TABLE `pricing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shippind_labels`
--
ALTER TABLE `shippind_labels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smartships`
--
ALTER TABLE `smartships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spark_mis_report`
--
ALTER TABLE `spark_mis_report`
  ADD PRIMARY KEY (`mis_id`);

--
-- Indexes for table `spark_ndr_report`
--
ALTER TABLE `spark_ndr_report`
  ADD PRIMARY KEY (`mis_id`);

--
-- Indexes for table `spark_single_order`
--
ALTER TABLE `spark_single_order`
  ADD PRIMARY KEY (`Single_Order_Id`),
  ADD KEY `Awb_Number` (`Awb_Number`);

--
-- Indexes for table `spark_single_order_file`
--
ALTER TABLE `spark_single_order_file`
  ADD PRIMARY KEY (`sparkorderid`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`spid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_billing`
--
ALTER TABLE `admin_billing`
  MODIFY `adbid` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_couriers`
--
ALTER TABLE `admin_couriers`
  MODIFY `courierid` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_financial`
--
ALTER TABLE `admin_financial`
  MODIFY `afid` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bulk_pincodes`
--
ALTER TABLE `bulk_pincodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_variables`
--
ALTER TABLE `client_variables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courier_list`
--
ALTER TABLE `courier_list`
  MODIFY `cl_pid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courier_permission`
--
ALTER TABLE `courier_permission`
  MODIFY `cp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hub_address`
--
ALTER TABLE `hub_address`
  MODIFY `hub_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manifestreport`
--
ALTER TABLE `manifestreport`
  MODIFY `manifest_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mis_report`
--
ALTER TABLE `mis_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `onlinecourierapidetails`
--
ALTER TABLE `onlinecourierapidetails`
  MODIFY `apidetailsid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `onlinecourierapis`
--
ALTER TABLE `onlinecourierapis`
  MODIFY `courier_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `onlineordersprod`
--
ALTER TABLE `onlineordersprod`
  MODIFY `orederprod_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderdetail_user`
--
ALTER TABLE `orderdetail_user`
  MODIFY `useru_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderstatus_labels`
--
ALTER TABLE `orderstatus_labels`
  MODIFY `labelid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderupdateawbs`
--
ALTER TABLE `orderupdateawbs`
  MODIFY `autoupdateid` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pickrr_status_code`
--
ALTER TABLE `pickrr_status_code`
  MODIFY `pickrr_status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pincodes`
--
ALTER TABLE `pincodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pincode_files`
--
ALTER TABLE `pincode_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pricing`
--
ALTER TABLE `pricing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shippind_labels`
--
ALTER TABLE `shippind_labels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `smartships`
--
ALTER TABLE `smartships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spark_mis_report`
--
ALTER TABLE `spark_mis_report`
  MODIFY `mis_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spark_ndr_report`
--
ALTER TABLE `spark_ndr_report`
  MODIFY `mis_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spark_single_order`
--
ALTER TABLE `spark_single_order`
  MODIFY `Single_Order_Id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spark_single_order_file`
--
ALTER TABLE `spark_single_order_file`
  MODIFY `sparkorderid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `spid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
