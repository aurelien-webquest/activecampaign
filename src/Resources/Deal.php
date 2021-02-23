<?php

namespace TestMonitor\ActiveCampaign\Resources;


class Deal extends Resource
{
  /**
   * The id of the account.
   *
   * @var int
   */
  public $id;

  /**
   * Deal's title
   * @var string
   */
  public $title;

  /**
   * Deal's description
   * @var string
   */
  public $description;

  /**
   * Deal’s account id
   * @var string
   */
  public $account;

  /**
   * Deal's primary contact's id
   * @var string
   */
  public $contact;

  /**
   * Deal's value in cents. (i.e. $456.78 => 45678). Must be greater than or equal to zero.
   * @var int32
   */
  public $value;

  /**
   * Deal's currency in 3-digit ISO format, lowercased.
   * @var string
   */
  public $currency;

  /**
   * Deal's pipeline id. Required if deal.stage is not provided. If deal.group is not provided, the stage's pipeline will be assigned to the deal automatically.
   * @var string
   */
  public $group;

  /**
   * Deal's stage id. Required if deal.group is not provided. If deal.stage is not provided, the deal will be assigned with the first stage in the pipeline provided in deal.group.
   * @var string
   */
  public $stage;

  /**
   * Deal's owner id. Required if pipeline's auto-assign option is disabled.
   * @var string
   */
  public $owner;

  /**
   * Deal's percentage.
   * @var int32
   */
  public $percent;

  /**
   * Deal's status. See available values.
   * @var int32
   */
  public $status;

  /**
   * Deal's custom field values {customFieldId: string, fieldValue: string, fieldCurrency?:string}[]
   *
   * @var array of objects
   */
  public $fields;
}
