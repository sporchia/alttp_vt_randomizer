<?php

namespace ALttP\World;

class Retro extends Open
{
    /**
     * Create a new world and initialize all of the Regions within it.
     * In Retro we force certain config values that cannot be overriden.
     *
     * @param int    $id      Id of this world
     * @param array  $config  config for this world
     *
     * @return void
     */
    public function __construct(int $id = 0, array $config = [])
    {
        parent::__construct($id, array_merge($config, [
            'rom.rupeeBow' => true,
            'rom.genericKeys' => true,
            'region.takeAnys' => true,
            'region.wildKeys' => true,
        ]));
        
        if ($this->config('difficulty') !== 'custom') {
            switch ($this->config('item.pool')) {
            case 'hard':
            case 'expert':
            case 'crowd_control':
                $this->config['item.count.KeyD1'] = 0;
                $this->config['item.count.KeyA2'] = 0;
                $this->config['item.count.KeyD7'] = 0;
                $this->config['item.count.KeyD2'] = 0;

                $this->config['item.count.TwentyRupees2'] = 15 + $this->config('item.count.TwentyRupees2', 0);
                break;
            case 'normal':
                $this->config['item.count.KeyD1'] = 0;
                $this->config['item.count.KeyA2'] = 0;
                $this->config['item.count.TwentyRupees2'] = 10 + $this->config('item.count.TwentyRupees2', 0);
            }
        }
    }
}
