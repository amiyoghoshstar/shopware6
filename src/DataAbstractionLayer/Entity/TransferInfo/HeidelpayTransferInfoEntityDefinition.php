<?php

declare(strict_types=1);

namespace HeidelPayment6\DataAbstractionLayer\Entity\TransferInfo;

use Shopware\Core\Checkout\Order\Aggregate\OrderTransaction\OrderTransactionDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\CreatedAtField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FloatField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\UpdatedAtField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class HeidelpayTransferInfoEntityDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'heidelpay_transfer_info';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getCollectionClass(): string
    {
        return HeidelpayTransferInfoEntityCollection::class;
    }

    public function getEntityClass(): string
    {
        return HeidelpayTransferInfoEntity::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->setFlags(new PrimaryKey(), new Required()),

            (new FkField('transaction_id', 'transactionId', OrderTransactionDefinition::class))->addFlags(new Required()),

            (new StringField('iban', 'iban')),
            (new StringField('bic', 'bic')),
            (new StringField('holder', 'holder')),
            (new StringField('descriptor', 'descriptor')),
            (new FloatField('amount', 'amount')),

            new OneToOneAssociationField('transaction', 'transaction_id', 'id', OrderTransactionDefinition::class, false),

            new CreatedAtField(),
            new UpdatedAtField(),
        ]);
    }
}
