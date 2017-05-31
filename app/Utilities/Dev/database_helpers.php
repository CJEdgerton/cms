<?php

function returnRandomId($model)
{
	return $model::all()->random()->id;
}