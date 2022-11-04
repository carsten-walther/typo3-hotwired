CREATE TABLE tx_hotwiredtodos_domain_model_todolist (
	name varchar(255) NOT NULL DEFAULT '',
	todos int(11) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_hotwiredtodos_domain_model_todo (
	todolist int(11) unsigned DEFAULT '0' NOT NULL,
	text text NOT NULL DEFAULT ''
);