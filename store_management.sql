-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2021 at 02:20 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `AcctTypeId` bigint(20) UNSIGNED NOT NULL,
  `AcctTypeName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `BankId` bigint(20) UNSIGNED NOT NULL,
  `BankName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `BankAddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_account_types`
--

CREATE TABLE `bank_account_types` (
  `BankAcctTypeId` bigint(20) UNSIGNED NOT NULL,
  `BankAcctTypeName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `BranId` bigint(20) UNSIGNED NOT NULL,
  `CateId` bigint(20) UNSIGNED NOT NULL,
  `BranName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `BranStatus` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`BranId`, `CateId`, `BranName`, `BranStatus`, `created_at`, `updated_at`) VALUES
(1, 4, 'test brand', 1, '2021-11-06 12:32:27', NULL),
(2, 2, 'demo brand', 1, '2021-11-06 12:32:32', '2021-11-06 12:35:45'),
(3, 4, 'brand demo', 1, '2021-11-06 12:32:37', NULL),
(4, 4, 'brand test 22', 1, '2021-11-06 12:46:36', NULL),
(5, 4, 'brand test 21', 1, '2021-11-06 12:46:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CateId` bigint(20) UNSIGNED NOT NULL,
  `CateName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CateStatus` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CateId`, `CateName`, `CateStatus`, `created_at`, `updated_at`) VALUES
(1, 'Category  test test', 1, '2021-11-06 07:38:09', '2021-11-06 07:48:42'),
(2, 'Category  demo 2', 1, '2021-11-06 07:38:15', '2021-11-06 07:47:10'),
(3, 'Category  test 2', 1, '2021-11-06 07:39:21', '2021-11-06 07:46:50'),
(4, 'Category  demo', 1, '2021-11-06 07:48:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_accounts`
--

CREATE TABLE `chart_of_accounts` (
  `ChartOfAcctId` bigint(20) UNSIGNED NOT NULL,
  `ChartOfAcctName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ChartOfAcctNumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `AccountId` int(11) NOT NULL DEFAULT 0,
  `AcctBalance` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `OpeningDate` date NOT NULL,
  `ActiveStatus` tinyint(1) NOT NULL DEFAULT 1,
  `IsTransaction` tinyint(1) NOT NULL DEFAULT 0,
  `IsPredefined` tinyint(1) NOT NULL DEFAULT 0,
  `BankAcctNumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `BankId` bigint(20) UNSIGNED NOT NULL,
  `AcctTypeId` bigint(20) UNSIGNED NOT NULL,
  `BankAcctTypeId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_infos`
--

CREATE TABLE `company_infos` (
  `CompId` bigint(20) UNSIGNED NOT NULL,
  `CompTitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `BengleTitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CompName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `BengleName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CompAddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Mobile1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Mobile2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Mobile3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `debit_credits`
--

CREATE TABLE `debit_credits` (
  `DebiCredId` bigint(20) UNSIGNED NOT NULL,
  `Amount` double(10,2) NOT NULL,
  `TranId` bigint(20) UNSIGNED NOT NULL,
  `ChartOfAcctId` bigint(20) UNSIGNED NOT NULL,
  `DrCrTypeId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dr_cr_types`
--

CREATE TABLE `dr_cr_types` (
  `DrCrTypeId` bigint(20) UNSIGNED NOT NULL,
  `TypeName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `labour_rates`
--

CREATE TABLE `labour_rates` (
  `LaboId` bigint(20) UNSIGNED NOT NULL,
  `CateId` bigint(20) UNSIGNED NOT NULL,
  `SizeId` bigint(20) UNSIGNED NOT NULL,
  `LaboType` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Amount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(65, '2014_10_12_000000_create_users_table', 1),
(66, '2014_10_12_100000_create_password_resets_table', 1),
(67, '2019_08_19_000000_create_failed_jobs_table', 1),
(68, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(69, '2021_10_30_132443_create_categories_table', 1),
(70, '2021_10_30_134611_create_brands_table', 1),
(71, '2021_10_30_135419_create_sizes_table', 1),
(72, '2021_10_30_135629_create_thicknesses_table', 1),
(73, '2021_10_30_135902_create_stocks_table', 1),
(74, '2021_10_30_143637_create_company_infos_table', 1),
(75, '2021_10_30_161637_create_labour_rates_table', 1),
(76, '2021_10_30_165847_create_banks_table', 1),
(77, '2021_10_30_170113_create_account_types_table', 1),
(78, '2021_10_30_170205_create_bank_account_types_table', 1),
(79, '2021_10_30_170643_create_chart_of_accounts_table', 1),
(80, '2021_10_30_170838_create_vendors_table', 1),
(81, '2021_10_30_174216_create_dr_cr_types_table', 1),
(82, '2021_10_30_174733_create_transaction_types_table', 1),
(83, '2021_10_30_174917_create_transactions_table', 1),
(84, '2021_10_30_175900_create_debit_credits_table', 1),
(85, '2021_11_01_124917_create_user_roles_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `SizeId` bigint(20) UNSIGNED NOT NULL,
  `SizeName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SizeStatus` tinyint(1) NOT NULL DEFAULT 1,
  `CateId` bigint(20) UNSIGNED NOT NULL,
  `BranId` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`SizeId`, `SizeName`, `SizeStatus`, `CateId`, `BranId`, `created_at`, `updated_at`) VALUES
(1, '50\"\"', 1, 4, 4, '2021-11-06 12:47:21', '2021-11-06 12:53:44'),
(2, '60\"\"', 1, 4, 1, '2021-11-06 13:07:54', NULL),
(3, '80\"\"', 1, 4, 4, '2021-11-06 13:09:00', NULL),
(4, '22', 1, 4, 1, '2021-11-06 13:09:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `StocId` bigint(20) UNSIGNED NOT NULL,
  `CateId` bigint(20) UNSIGNED NOT NULL,
  `BranId` bigint(20) UNSIGNED NOT NULL,
  `SizeId` bigint(20) UNSIGNED NOT NULL,
  `ThicId` bigint(20) UNSIGNED NOT NULL,
  `StocValue` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`StocId`, `CateId`, `BranId`, `SizeId`, `ThicId`, `StocValue`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, 1, 220, '2021-11-06 13:15:53', '2021-11-06 13:16:14');

-- --------------------------------------------------------

--
-- Table structure for table `thicknesses`
--

CREATE TABLE `thicknesses` (
  `ThicId` bigint(20) UNSIGNED NOT NULL,
  `ThicName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ThicStatus` tinyint(1) NOT NULL DEFAULT 1,
  `CateId` bigint(20) UNSIGNED NOT NULL,
  `BranId` bigint(20) UNSIGNED NOT NULL,
  `SizeId` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thicknesses`
--

INSERT INTO `thicknesses` (`ThicId`, `ThicName`, `ThicStatus`, `CateId`, `BranId`, `SizeId`, `created_at`, `updated_at`) VALUES
(1, 'hulp', 1, 4, 4, 1, '2021-11-06 13:05:01', NULL),
(2, 'someting', 1, 4, 1, 4, '2021-11-06 13:09:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `TranId` bigint(20) UNSIGNED NOT NULL,
  `TranDate` date NOT NULL,
  `TranTypeId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_types`
--

CREATE TABLE `transaction_types` (
  `TranTypeId` bigint(20) UNSIGNED NOT NULL,
  `TranTypeName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Muajjam hossain', 'admin@gmail.com', NULL, '$2y$10$XEVTm2m8TcDPtiwLfZMSF.DvUGfmMhEOijF/OFKFesEOt5Xgk.GrG', NULL, '2021-11-05 23:36:05', '2021-11-05 23:36:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `VendId` bigint(20) UNSIGNED NOT NULL,
  `VendName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ContactName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `VendAddress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Mobile1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Balance` double(10,2) NOT NULL DEFAULT 0.00,
  `InitialBalance` double(10,2) NOT NULL DEFAULT 0.00,
  `OpeningDate` date NOT NULL,
  `ActiveStatus` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ChartOfAcctId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`VendId`, `VendName`, `ContactName`, `VendAddress`, `Mobile1`, `Balance`, `InitialBalance`, `OpeningDate`, `ActiveStatus`, `created_at`, `updated_at`, `ChartOfAcctId`) VALUES
(1, 'test name', 'test', 'Dhanmondi', '02983465', 12323.00, 21232.00, '2020-11-10', 1, '2021-11-06 05:36:27', '2021-11-06 13:18:37', 1),
(2, 'test demo', 'demo', 'Uttora', '019348567', 500.00, 52100.00, '2021-11-08', 1, '2021-11-06 13:17:31', '2021-11-06 07:17:31', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`AcctTypeId`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`BankId`);

--
-- Indexes for table `bank_account_types`
--
ALTER TABLE `bank_account_types`
  ADD PRIMARY KEY (`BankAcctTypeId`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`BranId`),
  ADD KEY `brands_cateid_foreign` (`CateId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CateId`),
  ADD UNIQUE KEY `categories_catename_unique` (`CateName`);

--
-- Indexes for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD PRIMARY KEY (`ChartOfAcctId`),
  ADD KEY `chart_of_accounts_bankid_foreign` (`BankId`),
  ADD KEY `chart_of_accounts_accttypeid_foreign` (`AcctTypeId`),
  ADD KEY `chart_of_accounts_bankaccttypeid_foreign` (`BankAcctTypeId`);

--
-- Indexes for table `company_infos`
--
ALTER TABLE `company_infos`
  ADD PRIMARY KEY (`CompId`);

--
-- Indexes for table `debit_credits`
--
ALTER TABLE `debit_credits`
  ADD PRIMARY KEY (`DebiCredId`),
  ADD KEY `debit_credits_tranid_foreign` (`TranId`),
  ADD KEY `debit_credits_chartofacctid_foreign` (`ChartOfAcctId`),
  ADD KEY `debit_credits_drcrtypeid_foreign` (`DrCrTypeId`);

--
-- Indexes for table `dr_cr_types`
--
ALTER TABLE `dr_cr_types`
  ADD PRIMARY KEY (`DrCrTypeId`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `labour_rates`
--
ALTER TABLE `labour_rates`
  ADD PRIMARY KEY (`LaboId`),
  ADD KEY `labour_rates_cateid_foreign` (`CateId`),
  ADD KEY `labour_rates_sizeid_foreign` (`SizeId`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`SizeId`),
  ADD KEY `sizes_cateid_foreign` (`CateId`),
  ADD KEY `sizes_branid_foreign` (`BranId`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`StocId`),
  ADD KEY `stocks_cateid_foreign` (`CateId`),
  ADD KEY `stocks_branid_foreign` (`BranId`),
  ADD KEY `stocks_thicid_foreign` (`ThicId`),
  ADD KEY `stocks_sizeid_foreign` (`SizeId`);

--
-- Indexes for table `thicknesses`
--
ALTER TABLE `thicknesses`
  ADD PRIMARY KEY (`ThicId`),
  ADD KEY `thicknesses_cateid_foreign` (`CateId`),
  ADD KEY `thicknesses_branid_foreign` (`BranId`),
  ADD KEY `thicknesses_sizeid_foreign` (`SizeId`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`TranId`),
  ADD KEY `transactions_trantypeid_foreign` (`TranTypeId`);

--
-- Indexes for table `transaction_types`
--
ALTER TABLE `transaction_types`
  ADD PRIMARY KEY (`TranTypeId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`VendId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_types`
--
ALTER TABLE `account_types`
  MODIFY `AcctTypeId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `BankId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_account_types`
--
ALTER TABLE `bank_account_types`
  MODIFY `BankAcctTypeId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `BranId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CateId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  MODIFY `ChartOfAcctId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_infos`
--
ALTER TABLE `company_infos`
  MODIFY `CompId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `debit_credits`
--
ALTER TABLE `debit_credits`
  MODIFY `DebiCredId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dr_cr_types`
--
ALTER TABLE `dr_cr_types`
  MODIFY `DrCrTypeId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `labour_rates`
--
ALTER TABLE `labour_rates`
  MODIFY `LaboId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `SizeId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `StocId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `thicknesses`
--
ALTER TABLE `thicknesses`
  MODIFY `ThicId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `TranId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_types`
--
ALTER TABLE `transaction_types`
  MODIFY `TranTypeId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `VendId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `brands_cateid_foreign` FOREIGN KEY (`CateId`) REFERENCES `categories` (`CateId`) ON DELETE CASCADE;

--
-- Constraints for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD CONSTRAINT `chart_of_accounts_accttypeid_foreign` FOREIGN KEY (`AcctTypeId`) REFERENCES `account_types` (`AcctTypeId`),
  ADD CONSTRAINT `chart_of_accounts_bankaccttypeid_foreign` FOREIGN KEY (`BankAcctTypeId`) REFERENCES `bank_account_types` (`BankAcctTypeId`),
  ADD CONSTRAINT `chart_of_accounts_bankid_foreign` FOREIGN KEY (`BankId`) REFERENCES `banks` (`BankId`);

--
-- Constraints for table `debit_credits`
--
ALTER TABLE `debit_credits`
  ADD CONSTRAINT `debit_credits_chartofacctid_foreign` FOREIGN KEY (`ChartOfAcctId`) REFERENCES `chart_of_accounts` (`ChartOfAcctId`),
  ADD CONSTRAINT `debit_credits_drcrtypeid_foreign` FOREIGN KEY (`DrCrTypeId`) REFERENCES `dr_cr_types` (`DrCrTypeId`),
  ADD CONSTRAINT `debit_credits_tranid_foreign` FOREIGN KEY (`TranId`) REFERENCES `transactions` (`TranId`);

--
-- Constraints for table `labour_rates`
--
ALTER TABLE `labour_rates`
  ADD CONSTRAINT `labour_rates_cateid_foreign` FOREIGN KEY (`CateId`) REFERENCES `categories` (`CateId`) ON DELETE CASCADE,
  ADD CONSTRAINT `labour_rates_sizeid_foreign` FOREIGN KEY (`SizeId`) REFERENCES `sizes` (`SizeId`) ON DELETE CASCADE;

--
-- Constraints for table `sizes`
--
ALTER TABLE `sizes`
  ADD CONSTRAINT `sizes_branid_foreign` FOREIGN KEY (`BranId`) REFERENCES `brands` (`BranId`) ON DELETE CASCADE,
  ADD CONSTRAINT `sizes_cateid_foreign` FOREIGN KEY (`CateId`) REFERENCES `categories` (`CateId`) ON DELETE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_branid_foreign` FOREIGN KEY (`BranId`) REFERENCES `brands` (`BranId`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_cateid_foreign` FOREIGN KEY (`CateId`) REFERENCES `categories` (`CateId`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_sizeid_foreign` FOREIGN KEY (`SizeId`) REFERENCES `sizes` (`SizeId`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_thicid_foreign` FOREIGN KEY (`ThicId`) REFERENCES `thicknesses` (`ThicId`) ON DELETE CASCADE;

--
-- Constraints for table `thicknesses`
--
ALTER TABLE `thicknesses`
  ADD CONSTRAINT `thicknesses_branid_foreign` FOREIGN KEY (`BranId`) REFERENCES `brands` (`BranId`) ON DELETE CASCADE,
  ADD CONSTRAINT `thicknesses_cateid_foreign` FOREIGN KEY (`CateId`) REFERENCES `categories` (`CateId`) ON DELETE CASCADE,
  ADD CONSTRAINT `thicknesses_sizeid_foreign` FOREIGN KEY (`SizeId`) REFERENCES `sizes` (`SizeId`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_trantypeid_foreign` FOREIGN KEY (`TranTypeId`) REFERENCES `transaction_types` (`TranTypeId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
