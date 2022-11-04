CREATE TABLE tx_chat_domain_model_room (
	name varchar(255) NOT NULL DEFAULT '',
	messages int(11) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_chat_domain_model_message (
	room int(11) unsigned DEFAULT '0' NOT NULL,
	text text NOT NULL DEFAULT '',
	username varchar(255) NOT NULL DEFAULT ''
);