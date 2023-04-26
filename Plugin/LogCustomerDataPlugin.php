<?php declare(strict_types=1);
/**
 * Copyright © 2023 LopezPaul. All rights reserved.
 *
 * @package  LopezPaul_CustomerRegistration
 * @author   Paul Lopez <paul.lopezm@gmail.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://www.lopezpaul.com/
 */
namespace LopezPaul\CustomerRegistration\Plugin;

use LopezPaul\CustomerRegistrationApi\Api\CustomerLogsInterface;
use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Api\Data\CustomerInterface;

/**
 * @see \Magento\Customer\Model\AccountManagement::createAccount()
 */
class LogCustomerDataPlugin
{

    /**
     * @param CustomerLogsInterface $customerLogs
     */
    public function __construct(
        private CustomerLogsInterface $customerLogs
    ) {
    }

    /**
     * Write custom log with customer basic info (firstname,lastname,email)
     *
     * @param AccountManagementInterface $subject
     * @param CustomerInterface $result
     * @param CustomerInterface $customer
     * @param string|null $password
     * @param string|null $redirectUrl
     * @return mixed
     */
    public function afterCreateAccount(
        AccountManagementInterface $subject,
        CustomerInterface $result,
        CustomerInterface $customer,
        string|null $password = null,
        string|null $redirectUrl = ''
    ):CustomerInterface {
        $this->customerLogs->write($customer);
        return $result;
    }
}
