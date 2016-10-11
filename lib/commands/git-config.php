<?php

/*
 * This file is part of Portrait
 */
namespace Portrait;

use Huxtable\Bot\Twitter;
use Huxtable\CLI\Command;
use Huxtable\Core\Utils;
use Huxtable\Pixel;

/**
 * @command		git-config
 * @desc		Configure the local project directory for Git
 * @usage		git-config
 */
$commandGitUser = new Command( 'git-config', 'Configure the local project directory for Git', function()
{
	GLOBAL $bot;

	$bot->executeGitCommand( 'config user.email selfportraitexe@cabreramade.co' );
	$bot->executeGitCommand( 'config user.name "@selfportraitexe"' );

	$bot->executeGitCommand( 'checkout --orphan selfportraitexe' );
});

return $commandGitUser;
