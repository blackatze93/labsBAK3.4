<?php

namespace App\Entity;

/**
 * Class for holding a calendar event's details.
 */
class EventEntity
{
    /**
     * @var mixed unique identifier of this event (optional)
     */
    protected $id;

    /**
     * @var string title/label of the calendar event
     */
    protected $title;

    /**
     * @var string URL Relative to current path
     */
    protected $url;

    /**
     * @var string HTML color code for the bg color of the event label
     */
    protected $bgColor;

    /**
     * @var string HTML color code for the foregorund color of the event label
     */
    protected $fgColor;

    /**
     * @var string css class for the event label
     */
    protected $cssClass;

    /**
     * @var \DateTime dateTime object of the event start date/time
     */
    protected $startDatetime;

    /**
     * @var \DateTime dateTime object of the event end date/time
     */
    protected $endDatetime;

    /**
     * @var bool Is this an all day event?
     */
    protected $allDay = false;

    /**
     * @var array Non-standard fields
     */
    protected $otherFields = array();

    public function __construct($title, \DateTime $startDatetime, \DateTime $endDatetime = null, $allDay = false)
    {
        $this->title = $title;
        $this->startDatetime = $startDatetime;
        $this->setAllDay($allDay);

        if (null === $endDatetime && false === $this->allDay) {
            throw new \InvalidArgumentException('Must specify an event End DateTime if not an all day event.');
        }

        $this->endDatetime = $endDatetime;
    }

    /**
     * Convert calendar event details to an array.
     *
     * @return array $event
     */
    public function toArray()
    {
        $event = array();

        if (null !== $this->id) {
            $event['id'] = $this->id;
        }

        $event['title'] = $this->title;
        $event['start'] = $this->startDatetime->format("Y-m-d\TH:i:sP");

        if (null !== $this->url) {
            $event['url'] = $this->url;
        }

        if (null !== $this->bgColor) {
            $event['backgroundColor'] = $this->bgColor;
            $event['borderColor'] = $this->bgColor;
        }

        if (null !== $this->fgColor) {
            $event['textColor'] = $this->fgColor;
        }

        if (null !== $this->cssClass) {
            $event['className'] = $this->cssClass;
        }
        if (null !== $this->endDatetime) {
            $event['end'] = $this->endDatetime->format("Y-m-d\TH:i:sP");
        }

        $event['allDay'] = $this->allDay;
        foreach ($this->otherFields as $field => $value) {
            $event[$field] = $value;
        }

        return $event;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setBgColor($color)
    {
        $this->bgColor = $color;
    }

    public function getBgColor()
    {
        return $this->bgColor;
    }

    public function setFgColor($color)
    {
        $this->fgColor = $color;
    }

    public function getFgColor()
    {
        return $this->fgColor;
    }

    public function setCssClass($class)
    {
        $this->cssClass = $class;
    }

    public function getCssClass()
    {
        return $this->cssClass;
    }

    public function setStartDatetime(\DateTime $start)
    {
        $this->startDatetime = $start;
    }

    public function getStartDatetime()
    {
        return $this->startDatetime;
    }

    public function setEndDatetime(\DateTime $end)
    {
        $this->endDatetime = $end;
    }

    public function getEndDatetime()
    {
        return $this->endDatetime;
    }

    public function setAllDay($allDay = false)
    {
        $this->allDay = (bool) $allDay;
    }

    public function getAllDay()
    {
        return $this->allDay;
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function addField($name, $value)
    {
        $this->otherFields[$name] = $value;
    }

    /**
     * @param string $name
     */
    public function removeField($name)
    {
        if (!array_key_exists($name, $this->otherFields)) {
            return;
        }
        unset($this->otherFields[$name]);
    }
}
