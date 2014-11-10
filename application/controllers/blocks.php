<?php

class BlocksController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function loadblocks()
    {
        // If blocks, get blocks
        $blocks = $this->model->getBlocks();

        foreach ($blocks as $key => $value) {
            $block = $value;
            $blockname = $block['name'];
            $this->block[$blockname] = $block;
        }

    }
}
