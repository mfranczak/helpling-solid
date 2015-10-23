DROP TABLE orders;

DROP TABLE jobs;

CREATE TABLE orders (
  reference TEXT(6) PRIMARY KEY,
  type TEXT(8) -- once, weekly, biweekly
);

CREATE TABLE jobs (
  reference TEXT(6) PRIMARY KEY,
  order_reference TEXT(6),
  appointment DATETIME not null,
  FOREIGN KEY (order_reference) REFERENCES orders(reference)
);

INSERT INTO orders (reference, type) VALUES ('DEO100', 'once');
INSERT INTO orders (reference, type) VALUES ('DEO101', 'once');
INSERT INTO orders (reference, type) VALUES ('DEO200', 'weekly');
INSERT INTO orders (reference, type) VALUES ('DEO201', 'weekly');
INSERT INTO orders (reference, type) VALUES ('DEO300', 'biweekly');
INSERT INTO orders (reference, type) VALUES ('DEO301', 'biweekly');
