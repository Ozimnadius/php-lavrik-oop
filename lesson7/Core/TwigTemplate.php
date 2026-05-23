<?php

namespace Core;

class TwigTemplate extends Template
{
	protected static ?self $instance = null;
	protected $twig = null;
}