<?php

namespace IMSGlobal\Caliper\entities\lis;

use \IMSGlobal\Caliper\entities;

class Membership extends entities\Entity implements entities\w3c\Membership {
    /** @var entities\agent\Person */
    private $member;
    /** @var entities\w3c\Organization */
    private $organization;
    /** @var entities\w3c\Role[] */
    private $roles = [];
    /** @var entities\w3c\Status */
    private $status;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new entities\EntityType(entities\EntityType::MEMBERSHIP));
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'member' => (!is_null($this->getMember()))
                ? $this->getMember()->getId()
                : null,
            'organization' => (!is_null($this->getOrganization()))
                ? $this->getOrganization()->getId()
                : null,
            'roles' => $this->getRoles(),
            'status' => $this->getStatus(),
        ]);
    }

    /** @return Person member */
    public function getMember() {
        return $this->member;
    }

    /**
     * @param Person $member
     * @return $this|Membership
     */
    public function setMember(entities\agent\Person $member) {
        $this->member = $member;
        return $this;
    }

    /** @return \w3c\Organization  organization */
    public function getOrganization() {
        return $this->organization;
    }

    /**
     * @param \w3c\Organization $organization
     * @return $this|Membership
     */
    public function setOrganization(entities\w3c\Organization $organization) {
        $this->organization = $organization;
        return $this;
    }

    /** @return \w3c\Role[] roles */
    public function getRoles() {
        return $this->roles;
    }

    /**
     * @param entities\w3c\Role|\w3c\Role[] $roles
     * @return $this|Membership
     */
    public function setRoles($roles) {
        if (!is_array($roles)) {
            $roles = [$roles];
        }

        foreach ($roles as $aRoles) {
            if (!($aRoles instanceof entities\w3c\Role)) {
                // FIXME: After PHP 5.5 is a requirement, change "IMSGlobal\Caliper\entities\w3c\Role" string to "::class".
                throw new \InvalidArgumentException(__METHOD__ . ': array of \IMSGlobal\Caliper\entities\w3c\Role expected');
            }
        }

        $this->roles = $roles;
        return $this;
    }

    /** @return entities\w3c\Status status */
    public function getStatus() {
        return $this->status;
    }

    /**
     * @param entities\w3c\Status $status
     * @return $this|Membership
     */
    public function setStatus(entities\w3c\Status $status) {
        $this->status = $status;
        return $this;
    }
}
