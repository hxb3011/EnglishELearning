<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\Spanner;

class InstancePartition extends \Google\Collection
{
  protected $collection_key = 'referencingDatabases';
  /**
   * @var string
   */
  public $config;
  /**
   * @var string
   */
  public $createTime;
  /**
   * @var string
   */
  public $displayName;
  /**
   * @var string
   */
  public $etag;
  /**
   * @var string
   */
  public $name;
  /**
   * @var int
   */
  public $nodeCount;
  /**
   * @var int
   */
  public $processingUnits;
  /**
   * @var string[]
   */
  public $referencingBackups;
  /**
   * @var string[]
   */
  public $referencingDatabases;
  /**
   * @var string
   */
  public $state;
  /**
   * @var string
   */
  public $updateTime;

  /**
   * @param string
   */
  public function setConfig($config)
  {
    $this->config = $config;
  }
  /**
   * @return string
   */
  public function getConfig()
  {
    return $this->config;
  }
  /**
   * @param string
   */
  public function setCreateTime($createTime)
  {
    $this->createTime = $createTime;
  }
  /**
   * @return string
   */
  public function getCreateTime()
  {
    return $this->createTime;
  }
  /**
   * @param string
   */
  public function setDisplayName($displayName)
  {
    $this->displayName = $displayName;
  }
  /**
   * @return string
   */
  public function getDisplayName()
  {
    return $this->displayName;
  }
  /**
   * @param string
   */
  public function setEtag($etag)
  {
    $this->etag = $etag;
  }
  /**
   * @return string
   */
  public function getEtag()
  {
    return $this->etag;
  }
  /**
   * @param string
   */
  public function setName($name)
  {
    $this->name = $name;
  }
  /**
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }
  /**
   * @param int
   */
  public function setNodeCount($nodeCount)
  {
    $this->nodeCount = $nodeCount;
  }
  /**
   * @return int
   */
  public function getNodeCount()
  {
    return $this->nodeCount;
  }
  /**
   * @param int
   */
  public function setProcessingUnits($processingUnits)
  {
    $this->processingUnits = $processingUnits;
  }
  /**
   * @return int
   */
  public function getProcessingUnits()
  {
    return $this->processingUnits;
  }
  /**
   * @param string[]
   */
  public function setReferencingBackups($referencingBackups)
  {
    $this->referencingBackups = $referencingBackups;
  }
  /**
   * @return string[]
   */
  public function getReferencingBackups()
  {
    return $this->referencingBackups;
  }
  /**
   * @param string[]
   */
  public function setReferencingDatabases($referencingDatabases)
  {
    $this->referencingDatabases = $referencingDatabases;
  }
  /**
   * @return string[]
   */
  public function getReferencingDatabases()
  {
    return $this->referencingDatabases;
  }
  /**
   * @param string
   */
  public function setState($state)
  {
    $this->state = $state;
  }
  /**
   * @return string
   */
  public function getState()
  {
    return $this->state;
  }
  /**
   * @param string
   */
  public function setUpdateTime($updateTime)
  {
    $this->updateTime = $updateTime;
  }
  /**
   * @return string
   */
  public function getUpdateTime()
  {
    return $this->updateTime;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(InstancePartition::class, 'Google_Service_Spanner_InstancePartition');
