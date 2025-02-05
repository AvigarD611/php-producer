<?php

namespace App\Dto;

class EventMessageDTO
{
    public string $id;
    public string $eventType;
    public string $objectId;
    public array $metadata;

    public function __construct(string $id, string $eventType, string $objectId, array $metadata)
    {
        $this->id = $id;
        $this->eventType = $eventType;
        $this->objectId = $objectId;
        $this->metadata = $metadata;
    }

    public function toJson(): string
    {
        return json_encode([
            'id'         => $this->id,
            'event_type' => $this->eventType,
            'object_id'  => $this->objectId,
            'metadata'   => $this->metadata,
        ]);
    }
}
