<?php

namespace Webleit\ZohoBooksApi\Modules;

/**
 * Class RecurringInvoices
 * @package Webleit\ZohoBooksApi\Modules
 */
class RecurringInvoices extends Documents
{
    /**
     * @param $id string
     * @return boolean
     */
    public function stop($id)
    {
        return $this->markAs($id, 'stop');
    }

    /**
     * @param $id string
     * @return boolean
     */
    public function resume($id)
    {
        return $this->markAs($id, 'resume');
    }

    /**
     * Override returned key
     *
     * This overrides the key that is returned from zoho, as they
     * send back 'recurring_invoices' instead of 'recurringinvoices'
     *
     * @return string
     */
    public function getResourceKey()
    {
        return 'recurring_invoices';
    }

    /**
     * Override returned API key name
     *
     * This overrides the API key name that is returned from zoho, as they
     * send back 'recurring_invoice_id' instead of 'recurringinvoices_id'
     *
     * @return string
     */
    public function getApiKeyName()
    {
        return 'recurring_invoice_id';
    }

    /**
     * Return all child invoices list
     * @param $id
     * @param array|null $params
     * @return array
     * @throws \Webleit\ZohoBooksApi\Exceptions\ErrorResponseException
     */
    public function getChildInvoices($id, ?array $params = []): array
    {
        $url = $this->client->getUrl() . $this->getUrl() . '/' . $id . '/invoices';

        $items = json_decode($this->client->rawGet($url, $params)->getContents(), true);

        return $items;
    }
}
