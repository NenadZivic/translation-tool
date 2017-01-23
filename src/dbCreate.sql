
DROP TABLE IF EXISTS example CASCADE;
CREATE TABLE example (
	id      bigserial NOT NULL,
	source  text NOT NULL,
	target  text NOT NULL,
	PRIMARY KEY(id)
);

DROP TABLE IF EXISTS translation CASCADE;
CREATE TABLE translation (
	id		bigserial NOT NULL,
	example_id int NOT NULL,
	email	text NOT NULL,
	translation text NOT NULL DEFAULT '',
	comment text NOT NULL DEFAULT '',
	PRIMARY KEY(id)
);

ALTER TABLE translation ADD CONSTRAINT fk_translation_id_ref_example_id FOREIGN KEY (example_id) REFERENCES example (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;