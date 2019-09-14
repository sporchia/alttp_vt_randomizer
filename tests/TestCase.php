<?php

use ALttP\Boss;
use ALttP\Item;
use ALttP\Support\ItemCollection;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->collected = new ItemCollection;
    }

    public function tearDown(): void
    {
        unset($this->collected);
        Item::clearCache();
        Boss::clearCache();
        parent::tearDown();
        $refl = new \ReflectionObject($this);
        foreach ($refl->getProperties() as $prop) {
            if (!$prop->isStatic() && 0 !== strpos($prop->getDeclaringClass()->getName(), 'PHPUnit_')) {
                $prop->setAccessible(true);
                $prop->setValue($this, null);
            }
        }
    }

    protected function addCollected(array $items)
    {
        foreach ($items as $item) {
            $this->collected->addItem(Item::get($item, $this->world));
        }
    }

    /**
     * Lets pretend all items doesn't include keys just in case it affects things
     */
    protected function allItems()
    {
        return $this->allItemsExcept(['BigKey', 'Key', 'ShopKey']);
    }

    protected function allItemsExcept(array $remove_items)
    {
        $items = Item::all($this->world)->copy()->manyKeys();
        foreach (array_merge($remove_items, ['BigKey', 'Key', 'ShopKey']) as $item) {
            switch ($item) {
                case 'AnySword':
                    $items->offsetUnset('L1Sword:' . $this->world->id);
                    $items->offsetUnset('L1SwordAndShield:' . $this->world->id);
                    $items->offsetUnset('ProgressiveSword:' . $this->world->id);
                    $items->offsetUnset('UncleSword:' . $this->world->id);
                    // no break
                case 'UpgradedSword':
                    $items->offsetUnset('UncleSword:' . $this->world->id);
                    $items->offsetUnset('L2Sword:' . $this->world->id);
                    $items->offsetUnset('MasterSword:' . $this->world->id);
                    $items->offsetUnset('L3Sword:' . $this->world->id);
                    $items->offsetUnset('L4Sword:' . $this->world->id);
                    break;
                case 'AnyBottle':
                    $items->offsetUnset('BottleWithBee:' . $this->world->id);
                    $items->offsetUnset('BottleWithFairy:' . $this->world->id);
                    $items->offsetUnset('BottleWithRedPotion:' . $this->world->id);
                    $items->offsetUnset('BottleWithGreenPotion:' . $this->world->id);
                    $items->offsetUnset('BottleWithBluePotion:' . $this->world->id);
                    $items->offsetUnset('Bottle:' . $this->world->id);
                    $items->offsetUnset('BottleWithGoldBee:' . $this->world->id);
                    break;
                case 'AnyBow':
                    $items->offsetUnset('Bow:' . $this->world->id);
                    $items->offsetUnset('BowAndArrows:' . $this->world->id);
                    $items->offsetUnset('BowAndSilverArrows:' . $this->world->id);
                    $items->offsetUnset('ProgressiveBow:' . $this->world->id);
                    break;
                case 'Flute':
                    $items->offsetUnset('OcarinaActive:' . $this->world->id);
                    $items->offsetUnset('OcarinaInactive:' . $this->world->id);
                    break;
                case 'Gloves':
                    $items->offsetUnset('ProgressiveGlove:' . $this->world->id);
                    $items->offsetUnset('PowerGlove:' . $this->world->id);
                    $items->offsetUnset('TitansMitt:' . $this->world->id);
                    break;
                default:
                    $items->offsetUnset($item . ':' . $this->world->id);
                    break;
            }
        }
        return $items;
    }
}
