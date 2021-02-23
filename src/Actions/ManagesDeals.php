<?php

namespace TestMonitor\ActiveCampaign\Actions;

use TestMonitor\ActiveCampaign\Resources\Deal;

trait ManagesDeals
{
  use ImplementsActions;

  /**
   * Get all deals.
   *
   * @return array
   */
  public function deals()
  {
    return $this->transformCollection(
      $this->get('deals'),
      Deal::class,
      'deals'
    );
  }

  /**
   * Find deal by name.
   *
   * @param string $name
   * @param string $field 'all', 'title', 'contact', 'org' (account name)
   *
   * @return Deal|null
   */
  public function findDeal($title, $field = 'all')
  {
    $deals = $this->transformCollection(
      $this->get('deals', ['query' => [
        'filters[search]' => $title,
        'filters[search_field]' => $field,
      ]]),
      Deal::class,
      'deals'
    );

    return array_shift($deals);
  }

  /**
   * Create new deal.
   *
   * @param array $data
   *
   * @return Deal|null
   */
  public function createDeal(array $data = [])
  {
    // Default values for required fields
    $default = [
      'value' => 0,
      'currency' => 'USD',
    ];
    $data = array_merge($default, $data);

    $deals = $this->transformCollection(
      $this->post('deals', ['json' => ['deal' => $data]]),
      Deal::class
    );

    return array_shift($deals);
  }

  /**
   * Update an deal.
   *
   * @param int $dealId
   * @param array $data
   *
   * @return Deal|null
   */
  public function updateDeal($dealId, array $data = [])
  {
    $deals = $this->transformCollection(
      $this->put("deals/{$dealId}", ['json' => ['deal' => $data]]),
      Deal::class
    );

    return array_shift($deals);
  }

  /**
   * Find or create a deal.
   *
   * @param string $name
   * @param array $data
   *
   * @return Deal
   */
  public function findOrCreateDeal($title, array $data = [])
  {
    $deal = $this->findDeal($title);

    if ($deal instanceof Deal) {
      return $deal;
    }
    if (!isset($data['title'])) {
      $data['title'] = $title;
    }

    return $this->createDeal($data);
  }

  /**
   * Update or create a deal.
   *
   * @param string $name
   * @param array $data
   *
   * @return Deal
   */
  public function updateOrCreateDeal($title, array $data = [])
  {
    $deal = $this->findDeal($title);

    if ($deal instanceof Deal) {
      return $this->updateDeal($deal->id, $data);
    }

    if (!isset($data['title'])) {
      $data['title'] = $title;
    }

    return $this->createDeal($data);
  }
}
