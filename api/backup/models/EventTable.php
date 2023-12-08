<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event_table".
 *
 * @property int $event_id
 * @property string $event_name
 * @property int $event_nbf_country
 * @property string $event_description
 * @property string $event_upload_path
 * @property int $event_country
 * @property int $event_state
 * @property int $event_city
 * @property string $event_start
 * @property string $event_end
 * @property int $event_category
 * @property string $event_duration
 * @property string $event_organizer
 * @property string $event_organizer_address
 * @property string $event_contact_person
 * @property string $event_contact_detail
 * @property string $event_address_detail
 * @property string $event_address_detail1
 * @property string $event_sponser_name
 * @property string $event_status
 */
class EventTable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event_table';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_nbf_country', 'event_country', 'event_state', 'event_city', 'event_category'], 'integer'],
            [['event_description', 'event_upload_path', 'event_sponser_name', 'event_status'], 'string'],
            [['event_start', 'event_end'], 'safe'],
            [['event_name'], 'string', 'max' => 150],
            [['event_duration', 'event_organizer', 'event_organizer_address', 'event_contact_person', 'event_contact_detail', 'event_address_detail', 'event_address_detail1'], 'string', 'max' => 120],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'event_id' => 'Event ID',
            'event_name' => 'Event Name',
            'event_nbf_country' => 'Event Nbf Country',
            'event_description' => 'Event Description',
            'event_upload_path' => 'Event Upload Path',
            'event_country' => 'Event Country',
            'event_state' => 'Event State',
            'event_city' => 'Event City',
            'event_start' => 'Event Start',
            'event_end' => 'Event End',
            'event_category' => 'Event Category',
            'event_duration' => 'Event Duration',
            'event_organizer' => 'Event Organizer',
            'event_organizer_address' => 'Event Organizer Address',
            'event_contact_person' => 'Event Contact Person',
            'event_contact_detail' => 'Event Contact Detail',
            'event_address_detail' => 'Event Address Detail',
            'event_address_detail1' => 'Event Address Detail1',
            'event_sponser_name' => 'Event Sponser Name',
            'event_status' => 'Event Status',
        ];
    }
}
