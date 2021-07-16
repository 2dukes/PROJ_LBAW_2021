TasteBuds helps people build a community of diverse, healthy and tasty eating habits.

## A4: Conceptual Data Model

This artefact contains the Conceptual Domain Model that will be used by the database, namely the UML class diagram that depicts the relationships between the entities of the domain.

### 1. Class Diagram

![](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/wikis/images/ebd/class_diagram.jpg)

**Figure 29:** UML Class Diagram

---

## A5: Relational Schema, Validation and Schema Refinement

This artefact contains the Relational Schema which depicts the relations in the way they will be represented in the database, as well as its validation, refinement and SQL code.

### 1. Relational Schema

Relation schemas are described in the compact notation: 

Relation Reference  | Relation Compact Notation   
------------------- | ---------------------------------
R01                 | frequently_asked_question(<ins>id</ins>, question **NN**, answer **NN**)
R02                 | unit(<ins>id</ins>, name **NN**)
R03                 | conversion(<ins>unit_1</ins> &#x2192; unit **NN** , <ins>unit_2</ins> &#x2192; unit **NN** , factor) 
R04                 | ingredient_recipe(<ins>id_recipe</ins> &#x2192; recipe, <ins>ingredient_id</ins> &#x2192; ingredient, unit_id &#x2192; unit, quantity **CK >= 0**)
R05                 | ingredient(<ins>id</ins>, name **NN**)
R06                 | tag(<ins>id</ins>, name **NN**)
R07                 | tag_recipe(<ins>id_tag</ins> &#x2192; tag, <ins>id_recipe</ins> &#x2192; recipe)
R08                 | category(<ins>id</ins>, name **NN**)
R09                 | step(<ins>id</ins>, name **NN**, description, id_recipe &#x2192; recipe)
R10                 | recipe(<ins>id</ins>, name **NN**, difficulty, description, servings **CK > 0**, preparation_time **CK >= 0**, cooking_time **CK >= 0**, additional_time **CK >= 0**, creation_time **DF datetime**, id_member &#x2192; member **NN**, id_category &#x2192; category, id_group &#x2192; group, score DF 0)
R11                 | favourite(<ins>id_recipe</ins> &#x2192; recipe, <ins>id_member</ins> &#x2192; member)
R12                 | group(<ins>id</ins>, name **NN**, description, visibility **NN**) 
R13                 | group_moderator(<ins>id_member</ins> &#x2192; member, <ins>id_group</ins> &#x2192; group)
R14                 | group_member(<ins>id_member</ins> &#x2192; member, <ins>id_group</ins> &#x2192; group)
R15                 | group_request(<ins>id_member</ins> &#x2192; member, <ins>id_group</ins> &#x2192; group, state **NN**, timestamp **DF datetime**)
R16                 | admin(<ins>id</ins>, email **UK NN**, password **NN**, name **NN**, username **UK NN**)
R17                 | member(<ins>id</ins>, email **UK NN**, password **NN**, name **NN**, username **UK NN**, city, bio, visibility **NN DF false**, is_banned **NN DF false**, country_id &#x2192; country, score DF 0)
R18                 | following(<ins>id_following</ins> &#x2192; member **NN**, <ins>id_followed</ins> &#x2192; member **NN**, state **NN**, timestamp **DF datetime**)
R19                 | country(<ins>id</ins>, abbreviation **NN**, name **NN**)
R20                 | message(<ins>id</ins>, text **NN**, read **NN DF false**, timestamp **DF datetime**, id_receiver &#x2192; member **NN**, id_sender &#x2192; member **NN**)
R21                 | comment(<ins>id</ins>, text **NN**, rating **CK rating >= 1 && rating <= 5**, post_time **DF datetime**, id_member &#x2192; member **NN**, id_recipe &#x2192; recipe **NN**)
R22                 | answer(<ins>id_comment</ins> &#x2192; comment, father_comment &#x2192; comment **NN**)
R23                 | comment_notification(<ins>id</ins>, read **NN DF false**, timestamp **DF datetime**, id_comment &#x2192; comment **NN**)
R24                 | delete_notification(<ins>id</ins>, read **NN DF false**, timestamp **DF datetime**, id_receiver &#x2192; member **NN**, name_recipe **NN**)
R25                 | favourite_notification(<ins>id</ins>, read **NN DF false**, timestamp **DF datetime**, id_caused_by &#x2192; member **NN**, id_recipe &#x2192; recipe **NN**)
R26                 | comment_report(<ins>id</ins>, id_reporter &#x2192; member **NN**, reason **NN**, active **NN**, id_comment &#x2192; comment **NN**)
R27                 | recipe_report(<ins>id</ins>, id_reporter &#x2192; member **NN**, reason **NN**, active **NN**, id_recipe &#x2192; recipe **NN**)

where UK means UNIQUE KEY, NN means NOT NULL, DF means DEFAULT and CK means CHECK.


### 2. Domains

Specification of additional domains: 

Domain Name         | Domain Specification   
------------------- | ---------------------------------
datetime            | DATE DEFAULT now()
Difficulty          | ENUM('easy','medium','hard','very hard')
State               | ENUM('pending','accepted','refused')

### 3. Schema Validation

Identification of all functional dependencies to achieve the normalization of all relation schemas. 

<table>
  <tr>
      <td colspan="2"><strong>Table R01 </strong>(frequently_asked_question)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD0101</td>
      <td>{id} &#x2192; {question, answer}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R02 </strong>(unit)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD0201</td>
      <td>{id} &#x2192; {name}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R03 </strong>(conversion)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {unit1, unit2}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD0301</td>
      <td>{unit1, unit2} &#x2192; {factor}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R04 </strong>(ingredient_recipe)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id_recipe, ingredient_id}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD0401</td>
      <td>{id_recipe, ingredient_id} &#x2192; {unit_id, quantity}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R05 </strong>(ingredient)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD0501</td>
      <td>{id} &#x2192; {name}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R06 </strong>(tag)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD0601</td>
      <td>{id} &#x2192; {name}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R07 </strong>(tag_recipe)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id_tag, id_recipe}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td colspan="2">(none)</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R08 </strong>(category)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD0801</td>
      <td>{id} &#x2192; {name}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R09 </strong>(step)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD0901</td>
      <td>{id} &#x2192; {name, description, id_recipe}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R10 </strong>(recipe)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD1001</td>
      <td>{id} &#x2192; {name, difficulty, description, servings, preparation_time, cooking_time, additional_time, creation_time, id_member, id_category, id_group, score}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R11 </strong>(favourite)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id_recipe, id_member}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD1101</td>
      <td></td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R12 </strong>(group)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD1201</td>
      <td>{id} &#x2192; {name, description, visibility}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R13 </strong>(group_moderator)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id_member, id_group}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td colspan="2">(none)</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R14 </strong>(group_member)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id_member, id_group}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td colspan="2">(none)</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R15 </strong>(group_request)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id_member, id_group}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD1501</td>
      <td>{id_member, id_group} &#x2192; {state, timestamp}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R16 </strong>(admin)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id}, {username}, {email}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD1601</td>
      <td>{id} &#x2192; {email, password, name, username}</td>
  </tr>
  <tr>
      <td>FD1602</td>
      <td>{username} &#x2192; {id, email, password, name}</td>
  </tr>
  <tr>
      <td>FD1603</td>
      <td>{email} &#x2192; {id, password, name, username}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R17 </strong>(member)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id}, {username}, {email}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD1701</td>
      <td>{id} &#x2192; {email, password, name, username, city, bio, visibility, is_banned, country_id, score}</td>
  </tr>
  <tr>
      <td>FD1702</td>
      <td>{username} &#x2192; {id, email, password, name, city, bio, visibility, is_banned, country_id, score}</td>
  </tr>
  <tr>
      <td>FD1703</td>
      <td>{email} &#x2192; {id, password, name, username, city, bio, visibility, is_banned, country_id, score}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R18 </strong>(following)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id_following, id_followed}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD1801</td>
      <td>{id_following, id_followed} &#x2192; {state, timestamp}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R19 </strong>(country)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD1901</td>
      <td>{id} &#x2192; {abbreviation, name}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R20 </strong>(message)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD2001</td>
      <td>{id} &#x2192; {read, timestamp, id_receiver, id_sender}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R21 </strong>(comment)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD2101</td>
      <td>{id} &#x2192; {text, rating, post_time, id_member, id_recipe}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R22 </strong>(answer)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id_comment}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD2201</td>
      <td>{id_comment} &#x2192; {father_comment}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R23</strong> (comment_notification)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD2301</td>
      <td>{id} &#x2192; {read, timestamp, id_receiver, id_comment}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R24 </strong>(delete_notification)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD2401</td>
      <td>{id} &#x2192; {read, timestamp, id_receiver, name_recipe}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R25 </strong>(favourite_notification)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD2501</td>
      <td>{id} &#x2192; {read, timestamp, id_receiver, id_caused_by, id_recipe}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R26 </strong>(comment_report)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD2601</td>
      <td>{id} &#x2192; {id_reporter, reason, active, id_comment}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
      <td colspan="2"><strong>Table R27 </strong>(recipe_report)</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Keys: </strong> {id}</td>
  </tr>
  <tr>
      <td colspan="2"><strong>Functional Dependencies</strong></td>
  </tr>
  <tr>
      <td>FD2701</td>
      <td>{id} &#x2192; {comment_report, reason, active, id_recipe}</td>
  </tr>
  <tr>
      <td><strong>Normal Form</strong></td>
      <td>BCNF</td>
  </tr>
</table>

As all relations' normal form is the BCNF no changes were required and the schema's normal form is BCNF.

### 4. SQL code
The SQL file can be consulted [here](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/blob/master/ebd/script.pgsql).

---

## A6: Indexes, Triggers, User Functions, Transactions and Population

This artefact contains the physical schema of the database, tuple estimation, and the most frequent queries to be performed. Lastly, it includes all the SQL code necessary to define all data integrity constraints, indexes, transactions, and triggers.

### 1. Database Workload

In this section we predict the system load, mainly focusing on tuple estimation, frequent queries and frequent updates.

#### 1.1. Tuple Estimation
    
| **Relation reference** | **Relation Name**         | **Order of magnitude** | **Estimated growth** |
| ---------------------- | ------------------------- | ---------------------- | -------------------- |
| R01                    | frequently_asked_question | tens                   | units per month      |
| R02                    | unit                      | units                  | units per month      |
| R03                    | conversion                | units                  | units per month      |
| R04                    | ingredient_recipe         | millions               | hundreds per month   |
| R05                    | ingredient                | thousands              | units per day        |
| R06                    | tag                       | hundreds               | tens per month       |
| R07                    | tag_recipe                | thousands              | thousands per day    |
| R08                    | category                  | units                  | units per year       |
| R09                    | step                      | tens of thousands      | thousands per day    |
| R10                    | recipe                    | thousands              | hundreds per day     |
| R11                    | favourite                 | millions               | thousands per day    |
| R12                    | group                     | hundreds               | tens per day         |
| R13                    | group_moderator           | hundreds               | tens per day         |
| R14                    | group_member              | thousands              | hundreds per day     |
| R15                    | group_request             | hundreds               | tens per day         |
| R16                    | admin                     | units                  | units per year       |
| R17                    | member                    | tens of thousands      | hundreds per day     |
| R18                    | following                 | tens of thousands      | hundreds per day     |
| R19                    | country                   | hundreds               | units per decade     |
| R20                    | message                   | millions               | thousands per day    |
| R21                    | comment                   | tens of thousands      | hundreds per day     |
| R22                    | answer                    | thousands              | tens per day         |
| R23                    | comment_notification      | tens of thousands      | thousands per day    |
| R24                    | delete_notification       | tens                   | units per month      |
| R25                    | favourite_notification    | millions               | thousands per day    |
| R26                    | comment_report            | hundreds               | units per day        |
| R27                    | recipe_report             | hundreds               | units per month      |

#### 1.2. Frequent Queries

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT01</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Get all of a member's recipes (that are not part of a group).</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>hundreds per day</td>
  </tr>
</table>

```sql
SELECT tb_recipe.id, tb_recipe.name, tb_recipe.description, tb_recipe.servings, 
    tb_recipe.preparation_time, tb_recipe.cooking_time, tb_recipe.additional_time,
    tb_recipe.creation_time, 
    tb_category.name AS category, coalesce(tb_recipe.score, 0) as score, 
	comment_elapsed_time(tb_recipe.creation_time) as elapsed_time

FROM tb_recipe JOIN tb_category ON tb_recipe.id_category = tb_category.id

WHERE id_member = $memberId AND id_group IS NULL AND recipe_visibility(tb_recipe.id, $id_viewer);
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT02</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Get recipes for a given category.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>hundreds per day</td>
  </tr>
</table>

```sql
SELECT id
FROM tb_recipe
WHERE id_category = $categoryId;
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT03</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Get recipes to show in the member feed.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>hundreds per day</td>
  </tr>
</table>

```sql
SELECT
	tb_recipe.id, tb_recipe.name as title,
	description,
	comment_elapsed_time(tb_recipe.creation_time) as elapsed_time,
	tb_member.name as member_name,
	tb_recipe.score
FROM tb_recipe
JOIN tb_member ON tb_recipe.id_member = tb_member.id
WHERE recipe_visibility(tb_recipe.id, $memberId)
ORDER BY creation_time DESC
LIMIT 5;
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT04</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Filter feed recipes by date.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>thousands per day</td>
  </tr>
</table>

```sql
SELECT 
    tb_recipe.id, tb_recipe.name as title, 
    description,
    comment_elapsed_time(tb_recipe.creation_time) as elapsed_time, 
    tb_member.name as member_name, 
    tb_recipe.score
FROM tb_recipe
JOIN tb_member ON tb_recipe.id_member = tb_member.id
WHERE recipe_visibility(tb_recipe.id, $memberId) AND creation_time > $lower_date_bound AND creation_time < $upper_date_bound
ORDER BY creation_time DESC;
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT05</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Filter feed recipes by difficulty.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>tens per day</td>
  </tr>
</table>

```sql
SELECT 
    tb_recipe.id, tb_recipe.name as title, 
    description,
    comment_elapsed_time(tb_recipe.creation_time) as elapsed_time, 
    tb_member.name as member_name, 
    tb_recipe.score
FROM tb_recipe
JOIN tb_member ON tb_recipe.id_member = tb_member.id
WHERE recipe_visibility(tb_recipe.id, $memberId) AND difficulty = $desired_difficulty
ORDER BY creation_time DESC;
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT06</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Filter feed recipes by score.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>tens per day</td>
  </tr>
</table>

```sql
SELECT 
    tb_recipe.id, tb_recipe.name as title, 
    description,
    comment_elapsed_time(tb_recipe.creation_time) as elapsed_time, 
    tb_member.name as member_name, 
    tb_recipe.score
FROM tb_recipe
JOIN tb_member ON tb_recipe.id_member = tb_member.id
WHERE recipe_visibility(tb_recipe.id, $memberId) AND score > $lower_score_bound AND score < $upper_score_bound
ORDER BY creation_time DESC;
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT07</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Get a given recipe's general information.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>thousands per day</td>
  </tr>
</table>

```sql
SELECT tb_recipe.name, tb_recipe.description, tb_recipe.servings, tb_recipe.preparation_time, tb_recipe.cooking_time, tb_recipe.additional_time,
    tb_recipe.creation_time, score, tb_member.name AS member_name, tb_member.username AS member_username, tb_category.name AS category,
    (SELECT COUNT(*) FROM tb_comment WHERE id_recipe = tb_recipe.id AND rating IS NOT NULL) AS number_ratings,
FROM tb_recipe
JOIN tb_member ON tb_recipe.id_member = tb_member.id
JOIN tb_category ON tb_recipe.id_category = tb_category.id
WHERE recipe_visibility(tb_recipe.id, $userId) = TRUE AND tb_recipe.id = $recipeId; -- $userId | $recipeId
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT08</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Get a given recipe's tags.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>thousands per day</td>
  </tr>
</table>

```sql
-- Tags

SELECT tb_tag.id, tb_tag.name
FROM tb_tag_recipe
JOIN tb_recipe ON tb_tag_recipe.id_recipe = tb_recipe.id
JOIN tb_tag ON tb_tag_recipe.id_tag = tb_tag.id
WHERE tb_recipe.id = $recipeId; -- $recipeId
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT09</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Get a given recipe's ingredients.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>thousands per day</td>
  </tr>
</table>

```sql
-- Ingredients

SELECT tb_ingredient.id, tb_ingredient.name, tb_ingredient_recipe.quantity, tb_unit.name
FROM tb_ingredient_recipe
JOIN tb_recipe ON tb_ingredient_recipe.id_recipe = tb_recipe.id
JOIN tb_ingredient ON tb_ingredient_recipe.id_ingredient = tb_ingredient.id
JOIN tb_unit ON tb_ingredient_recipe.id_unit = tb_unit.id
WHERE tb_recipe.id = $recipeId; -- $recipeId
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT10</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Get a given recipe's steps.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>thousands per day</td>
  </tr>
</table>

```sql
-- Steps

SELECT tb_step.id, tb_step.name, tb_step.description
FROM tb_step
JOIN tb_recipe ON tb_step.id_recipe = tb_recipe.id
WHERE tb_recipe.id = $recipeId; -- $recipeId
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT11</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Get a given recipe's comments.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>thousands per day</td>
  </tr>
</table>

```sql
-- Comments

SELECT tb_comment.id, tb_comment.text, comment_elapsed_time(tb_comment.post_time), tb_answer.father_comment, tb_member.name, tb_member.id
FROM tb_comment
JOIN tb_answer ON tb_comment.id = tb_answer.id_comment
JOIN tb_member ON tb_comment.id_member = tb_member.id
WHERE tb_comment.id_recipe = $recipeId; -- $recipeId
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT12</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Get a given recipe's reviews.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>thousands per day</td>
  </tr>
</table>

```sql
-- Reviews

SELECT tb_comment.id, tb_comment.text, tb_comment.rating, comment_elapsed_time(tb_comment.post_time)
FROM tb_comment
JOIN tb_recipe ON tb_comment.id = tb_recipe.id
WHERE tb_comment.rating IS NOT NULL AND tb_recipe.id = $recipeId; -- $recipeId
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT13</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Get the messages exchanged between two given members.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>hundreds per day</td>
  </tr>
</table>

```sql
SELECT *
FROM tb_message
WHERE (id_receiver = $memberId1 AND id_sender = $memberId2) OR (id_receiver = $memberId2 AND id_sender = $memberId1)
ORDER BY timestamp DESC;
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT14</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Get a given member's recipes' comment notifications.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>tens of thousands per day</td>
  </tr>
</table>

```sql
SELECT tb_comment_notification.id, read, tb_comment_notification.timestamp
FROM tb_comment_notification
JOIN tb_comment ON tb_comment_notification.id_comment = tb_comment.id
JOIN tb_recipe ON tb_comment.id_recipe = tb_recipe.id
JOIN tb_member ON tb_recipe.id_member = tb_member.id
WHERE tb_recipe.id_member = $userId;
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT15</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Get the delete notifications (deletion of one of his recipes by an admin) of a given member.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>tens of thousands per day</td>
  </tr>
</table>

```sql
SELECT tb_delete_notification.id, read, name_recipe, tb_delete_notification.timestamp
FROM tb_delete_notification
JOIN tb_member ON tb_delete_notification.id_receiver = tb_member.id
WHERE tb_delete_notification.id_receiver = $userId;
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT16</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Get the favourite notifications of a given member.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>tens of thousands per day</td>
  </tr>
</table>

```sql
SELECT tb_favourite_notification.id, read, tb_favourite_notification.timestamp, id_caused_by
FROM tb_favourite_notification
JOIN tb_recipe ON tb_favourite_notification.id_recipe = tb_recipe.id
JOIN tb_member ON tb_recipe.id_member = tb_member.id
WHERE tb_recipe.id_member = $userId;
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT17</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Get a given member's profile information.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>thousands per day</td>
  </tr>
</table>

```sql
SELECT tb_member.name, tb_member.username, tb_member.city, tb_member.bio, coalesce(tb_member.score, 0) AS score, tb_country.name AS country,
(SELECT COUNT(*) FROM tb_recipe WHERE id_member = tb_member.id) AS number_recipes,
(SELECT COUNT(*) FROM tb_following WHERE id_following = tb_member.id) AS number_following,
(SELECT COUNT(*) FROM tb_following WHERE id_followed = tb_member.id) AS number_followed
FROM tb_member
JOIN tb_country ON tb_member.id_country = tb_country.id
WHERE tb_member.id = $userId OR tb_member.username = $username; -- $userId or $username
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT18</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Get the members a given member follows.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>thousands per day</td>
  </tr>
</table>


```sql
-- Users following (Profile)

SELECT tb_following.id_followed 
FROM tb_following
WHERE tb_following.id_following = $userId; -- $userId
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT19</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Get the groups a given member is part of.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>thousands per day</td>
  </tr>
</table>

```sql
-- User Groups (Profile)

SELECT tb_group.id, tb_group.name
FROM tb_group_member
JOIN tb_group ON tb_group_member.id_group = tb_group.id
WHERE tb_group_member.id_member = $userId; -- $userId
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT20</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Get a given group's general information.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>thousands per day</td>
  </tr>
</table>

```sql
SELECT tb_group.name, tb_group.description
FROM tb_group
WHERE tb_group.id = $groupId; -- $groupId
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT21</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Get a given group's membership requests.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>thousands per day</td>
  </tr>
</table>

```sql
-- Group Requests

SELECT tb_group_request.state, tb_member.id, tb_member.name, tb_member.username
FROM tb_group_request
JOIN tb_member ON tb_group_request.id_member = tb_member.id
WHERE tb_group = $groupId; -- $groupId
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT22</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Get a given group's members.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>thousands per day</td>
  </tr>
</table>

```sql
-- Group Members

SELECT tb_group_member.id_member, tb_member.username
FROM tb_group_member
JOIN tb_member ON tb_group_member.id_member = tb_member.id
WHERE tb_group = $groupId; -- $groupId
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT23</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Get a given group's recipes.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>thousands per day</td>
  </tr>
</table>

```sql
SELECT tb_recipe.id, tb_recipe.name, tb_recipe.description, tb_recipe.servings, 
    tb_recipe.preparation_time, tb_recipe.cooking_time, tb_recipe.additional_time,
    tb_recipe.creation_time, 
    tb_category.name AS category, coalesce(tb_recipe.score, 0) as score, 
	comment_elapsed_time(tb_recipe.creation_time) as elapsed_time

FROM tb_recipe JOIN tb_category ON tb_recipe.id_category = tb_category.id

WHERE id_group = $id_group;
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT24</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Search recipes for a given query.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>tens of thousands per day</td>
  </tr>
</table>

```sql    
SELECT *, ts_rank("search", to_tsquery('english', 'egg | beef')) AS "rank"
FROM recipes_fts_view
WHERE "search" @@ to_tsquery('english', 'egg | beef') AND recipe_visibility(recipes_fts_view.recipe_id, $userId) = TRUE
ORDER BY "rank" DESC;
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT25</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Search categories for a given query.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>tens of thousands per day</td>
  </tr>
</table>

```sql
SELECT *, ts_rank("search", to_tsquery('english', 'Desserts')) AS "rank"
FROM tb_category
WHERE "search" @@ to_tsquery('english', 'Desserts')
ORDER BY "rank" DESC;
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT26</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Search members for a given query.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>tens of thousands per day</td>
  </tr>
</table>

```sql
SELECT *, ts_rank("search", to_tsquery('simple', 'Mihai | Searle')) AS "rank"
FROM tb_member
WHERE "search" @@ to_tsquery('simple', 'Mihai | Searle')
ORDER BY "rank" DESC;
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>SELECT27</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Search groups for a given query.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>tens of thousands per day</td>
  </tr>
</table>

```sql
SELECT *, ts_rank("search", to_tsquery('english', 'Chef | Cook')) AS "rank"
FROM tb_group
WHERE "search" @@ to_tsquery('english', 'Chef | Cook')
ORDER BY "rank" DESC;
```

#### 1.3. Frequent Updates

<table>
  <tr>
      <th>Query</th>
      <td><strong>UPDATE01</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Insert new recipe.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>tens per day</td>
  </tr>
</table>

```sql
INSERT INTO tb_recipe (name, difficulty, description, servings, preparation_time, cooking_time, additional_time, visibility, creation_time, id_member, id_category)
VALUES ($title, $difficulty, $description, $servings, $preparation_time, $cooking_time, $additional_time, $visibility, $creation_time, $id_member, $id_category);
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>UPDATE02</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Insert new recipe step.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>tens per day</td>
  </tr>
</table>

```sql
INSERT INTO tb_step (name, description, id_recipe) VALUES ($step_name, $step_description, $id_recipe);
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>UPDATE03</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Insert new recipe tag.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>tens per day</td>
  </tr>
</table>


```sql
INSERT INTO tb_tag_recipe (id_tag, id_recipe) VALUES ($id_tag, $id_recipe);
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>UPDATE04</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Insert new recipe ingredient.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>tens per day</td>
  </tr>
</table>

```sql
INSERT INTO tb_ingredient_recipe (id_recipe, id_ingredient, id_unit, quantity) VALUES ($id_recipe, $id_ingredient, $id_unit, $quantity);
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>UPDATE05</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Update a given recipe's general information.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>tens per day</td>
  </tr>
</table>

```sql
UPDATE tb_recipe
SET difficulty = $difficulty, description = $description, servings = $servings, preparation_time = $preparation_time, 
cooking_time = $cooking_time, additional_time = $additional_time, 
visibility = $visibility, id_category = $category
WHERE id = $recipeId;
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>UPDATE06</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Update a given recipe step.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>tens per day</td>
  </tr>
</table>

```sql
UPDATE tb_step   -- may need to update steps, may be repeated as necessary
SET name = $new_step_name, description = $new_step_description  
WHERE id = $id_step_to_update;
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>UPDATE07</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Update a given recipe's ingredient.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>tens per day</td>
  </tr>
</table>

```sql
UPDATE tb_ingredient_recipe  -- may need to update recipe ingredients, may be repeated as necessary
SET id_unit = $new_id_unit, quantity = $new_quantity
WHERE id_recipe = $id_recipe AND id_ingredient = $id_ingredient_to_update;
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>UPDATE08</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Delete a given recipe.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>units per day</td>
  </tr>
</table>

```sql
DELETE FROM tb_recipe WHERE id = $recipeId;   -- It should cascade to the steps, ingredient_recipes and comments
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>UPDATE09</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Create a review.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>thousands per day</td>
  </tr>
</table>

```sql
INSERT INTO tb_comment(text, rating, id_member, id_recipe) 
VALUES($text, $rating, $id_member, $id_recipe);
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>UPDATE10</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Create a comment.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>thousands per day</td>
  </tr>
</table>

```sql
INSERT INTO tb_comment (text, id_member, id_recipe)
VALUES ($text, $id_member, $id_recipe);
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>UPDATE11</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Delete a comment/review.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>hundreds per day</td>
  </tr>
</table>

```sql
DELETE FROM tb_comment
WHERE id = $commentId;
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>UPDATE12</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Create a private message.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>thousands per day</td>
  </tr>
</table>

```sql
-- User A sends a message to the user B
INSERT INTO tb_message (text, id_receiver, id_sender)
    VALUES ($text, $id_user_b, $id_user_a);
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>UPDATE13</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Update comment notification read status.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>thousands per day</td>
  </tr>
</table>

```sql
UPDATE tb_comment_notification
SET read = TRUE
WHERE id = $idCommentNotification;
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>UPDATE14</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Update delete notification read status.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>thousands per day</td>
  </tr>
</table>

```sql
UPDATE tb_delete_notification
SET read = TRUE
WHERE id = $idDeleteNotification;
```

---

<table>
  <tr>
      <th>Query</th>
      <td><strong>UPDATE15</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>Update favourite notification read status.</td>
  </tr>
  <tr>
      <th>Frequency</th>
      <td>thousands per day</td>
  </tr>
</table>

```sql
UPDATE tb_favourite_notification
SET read = TRUE
WHERE id = $idFavouriteNotification;
```

### 2. Proposed Indices

#### 2.1. Performance Indices

<table>
  <tr>
      <th>Index</th>
      <td><strong>IDX01</strong></td>
  </tr>
  <tr>
      <th>Related Queries</th>
      <td>SELECT01, SELECT03, SELECT04, SELECT05, SELECT06,  SELECT07</td>
  </tr>
  <tr>
      <th>Relation</th>
      <td>tb_recipe</td>
  </tr>
  <tr>
      <th>Attribute</th>
      <td>id_member</td>
  </tr>
  <tr>
      <th>Type</th>
      <td>Hash</td>
  </tr>
  <tr>
      <th>Cardinality</th>
      <td>Medium</td>
  </tr>
  <tr>
      <th>Clustering</th>
      <td>Yes</td>
  </tr>
  <tr>
      <th>Justification</th>
      <td>Queries related have to be very fast and executed many times; doesn't need range query support; cardinality is medium, so it's a good candidate for clustering.</td>
  </tr>
</table>

```sql
DROP INDEX IF EXISTS member_recipe_index;
CREATE INDEX member_recipe_index ON tb_recipe USING hash(id_member);
```

---

<table>
  <tr>
      <th>Index</th>
      <td><strong>IDX02</strong></td>
  </tr>
  <tr>
      <th>Related Queries</th>
      <td>SELECT02, SELECT07</td>
  </tr>
  <tr>
      <th>Relation</th>
      <td>tb_recipe</td>
  </tr>
  <tr>
      <th>Attribute</th>
      <td>id_category</td>
  </tr>
  <tr>
      <th>Type</th>
      <td>Hash</td>
  </tr>
  <tr>
      <th>Cardinality</th>
      <td>Low</td>
  </tr>
  <tr>
      <th>Clustering</th>
      <td>Yes</td>
  </tr>
  <tr>
      <th>Justification</th>
      <td>Query SELECT02 and SELECT07 are used to search recipes' categories. It has to be fast because it's executed many times; doesn't need range query support and, because cardinality is low, it's a good candidate for clustering.</td>
  </tr>
</table>

```sql
DROP INDEX IF EXISTS category_recipe_index;
CREATE INDEX category_recipe_index ON tb_recipe USING hash(id_category);
```

---

<table>
  <tr>
      <th>Index</th>
      <td><strong>IDX03</strong></td>
  </tr>
  <tr>
      <th>Related Queries</th>
      <td>SELECT23</td>
  </tr>
  <tr>
      <th>Relation</th>
      <td>tb_recipe</td>
  </tr>
  <tr>
      <th>Attribute</th>
      <td>id_group</td>
  </tr>
  <tr>
      <th>Type</th>
      <td>Hash</td>
  </tr>
  <tr>
      <th>Cardinality</th>
      <td>Medium</td>
  </tr>
  <tr>
      <th>Clustering</th>
      <td>No</td>
  </tr>
  <tr>
      <th>Justification</th>
      <td>Query SELECT23 has to be fast because it's executed many times; it does not need range support; cardinality is medium and, because the table tb_recipe has big tuples, it's not a good candidate for clustering.</td>
  </tr>
</table>

```sql
DROP INDEX IF EXISTS group_recipe_index;
CREATE INDEX group_recipe_index ON tb_recipe USING hash(id_group);
```

---

<table>
  <tr>
      <th>Index</th>
      <td><strong>IDX04</strong></td>
  </tr>
  <tr>
      <th>Related Queries</th>
      <td>SELECT13</td>
  </tr>
  <tr>
      <th>Relation</th>
      <td>tb_message</td>
  </tr>
  <tr>
      <th>Attribute</th>
      <td>(id_sender, id_receiver)</td>
  </tr>
  <tr>
      <th>Type</th>
      <td>B-tree</td>
  </tr>
  <tr>
      <th>Cardinality</th>
      <td>Medium</td>
  </tr>
  <tr>
      <th>Clustering</th>
      <td>Yes</td>
  </tr>
  <tr>
      <th>Justification</th>
      <td>Query SELECT13 is used to search the messages between two users really fast. It doesn't need range query support; cardinality is medium so it's a good candidate for clustering.</td>
  </tr>
</table>

```sql
DROP INDEX IF EXISTS message_index;
CREATE INDEX message_index ON tb_message (id_sender, id_receiver);
```

---

<table>
  <tr>
      <th>Index</th>
      <td><strong>IDX05</strong></td>
  </tr>
  <tr>
      <th>Related Queries</th>
      <td>SELECT06</td>
  </tr>
  <tr>
      <th>Relation</th>
      <td>tb_recipe</td>
  </tr>
  <tr>
      <th>Attribute</th>
      <td>score</td>
  </tr>
  <tr>
      <th>Type</th>
      <td>B-tree</td>
  </tr>
  <tr>
      <th>Cardinality</th>
      <td>Medium</td>
  </tr>
  <tr> 
      <th>Clustering</th>
      <td>No</td>
  </tr>
  <tr>
      <th>Justification</th>
      <td>Query SELECT06 is used to filter feed recipes by score. It needs range query support; cardinality is medium and, as table tb_recipe has many tuples, it's not a good candidate for clustering.</td>
  </tr>
</table>

```sql
DROP INDEX IF EXISTS rating_index;
CREATE INDEX rating_index ON tb_recipe USING btree(score); -- B-tree by default
```

---

<table>
  <tr>
      <th>Index</th>
      <td><strong>IDX06</strong></td>
  </tr>
  <tr>
      <th>Related Queries</th>
      <td>SELECT11</td>
  </tr>
  <tr>
      <th>Relation</th>
      <td>tb_comment</td>
  </tr>
  <tr>
      <th>Attribute</th>
      <td>id_recipe</td>
  </tr>
  <tr>
      <th>Type</th>
      <td>Hash</td>
  </tr>
  <tr>
      <th>Cardinality</th>
      <td>Medium</td>
  </tr>
  <tr>
      <th>Clustering</th>
      <td>Yes</td>
  </tr>
  <tr>
      <th>Justification</th>
      <td>Query SELECT11 is used to get a recipe's comments. It has to be executed many times; It doesn't need range support; cardinality is medium, so it's a good candidate for clustering.</td>
  </tr>
</table>

```sql
DROP INDEX IF EXISTS recipe_comment_index;
CREATE INDEX recipe_comment_index ON tb_comment USING hash(id_recipe);
```

---

<table>
  <tr>
      <th>Index</th>
      <td><strong>IDX07</strong></td>
  </tr>
  <tr>
      <th>Related Queries</th>
      <td>SELECT15</td>
  </tr>
  <tr>
      <th>Relation</th>
      <td>tb_delete_notification</td>
  </tr>
  <tr>
      <th>Attribute</th>
      <td>id_receiver</td>
  </tr>
  <tr>
      <th>Type</th>
      <td>Hash</td>
  </tr>
  <tr>
      <th>Cardinality</th>
      <td>Medium</td>
  </tr>
  <tr>
      <th>Clustering</th>
      <td>No</td>
  </tr>
  <tr>
      <th>Justification</th>
      <td>Query SELECT15 is used to get the delete notifications of a given member. It doesn't need range support; cardinality is medium, so it's not a good candidate for clustering.</td>
  </tr>
</table>

```sql
DROP INDEX IF EXISTS receiver_delete_notification_index;
CREATE INDEX receiver_delete_notification_index ON tb_delete_notification USING hash(id_receiver);
```

---

<table>
  <tr>
      <th>Index</th>
      <td><strong>IDX08</strong></td>
  </tr>
  <tr>
      <th>Related Queries</th>
      <td>SELECT04</td>
  </tr>
  <tr>
      <th>Relation</th>
      <td>tb_recipe</td>
  </tr>
  <tr>
      <th>Attribute</th>
      <td>creation_time</td>
  </tr>
  <tr>
      <th>Type</th>
      <td>B-tree</td>
  </tr>
  <tr>
      <th>Cardinality</th>
      <td>High</td>
  </tr>
  <tr>
      <th>Clustering</th>
      <td>No</td>
  </tr>
  <tr>
      <th>Justification</th>
      <td>Query SELECT04 is used to filter recipes by date. It has to be fast because it's executed many times. It needs range query support and cardinality is high because the exact creation_time of a recipe will be practically unique. It's not a good candidate for clustering.</td>
  </tr>
</table>

```sql
DROP INDEX IF EXISTS recipe_creation_time_index;
CREATE INDEX recipe_creation_time_index ON tb_recipe USING btree(creation_time);
```

---

<table>
  <tr>
      <th>Index</th>
      <td><strong>IDX09</strong></td>
  </tr>
  <tr>
      <th>Related Queries</th>
      <td>SELECT05</td>
  </tr>
  <tr>
      <th>Relation</th>
      <td>tb_recipe</td>
  </tr>
  <tr>
      <th>Attribute</th>
      <td>difficulty</td>
  </tr>
  <tr>
      <th>Type</th>
      <td>Hash</td>
  </tr>
  <tr>
      <th>Cardinality</th>
      <td>Low</td>
  </tr>
  <tr>
      <th>Clustering</th>
      <td>Yes</td>
  </tr>
  <tr>
      <th>Justification</th>
      <td>Query SELECT05 is used to filter feed recipes by difficulty. It's executed many times and doesn't need range query support. Cardinality is low, so it's a good candidate for clustering.</td>
  </tr>
</table>

```sql
DROP INDEX IF EXISTS recipe_difficulty_index;
CREATE INDEX recipe_difficulty_index ON tb_recipe USING hash(difficulty);
```

#### 2.2. Full-text Search Indices

<table>
  <tr>
      <th>Index</th>
      <td><strong>IDX10</strong></td>
  </tr>
  <tr>
      <th>Related Queries</th>
      <td>SELECT25</td>
  </tr>
  <tr>
      <th>Relation</th>
      <td>tb_category</td>
  </tr>
  <tr>
      <th>Attribute</th>
      <td>search</td>
  </tr>
  <tr>
      <th>Type</th>
      <td>GIN</td>
  </tr>
  <tr>
      <th>Clustering</th>
      <td>No</td>
  </tr>
  <tr>
      <th>Justification</th>
      <td>Query SELECT25 is used to search categories given by a user's input (FTS). It's executed many times so it has to be fast. It's a GIN because the referred tuple won't be updated that frequently. This way we make searches fast. No clustering needed because the search has high cardinality.</td>
  </tr>
</table>

```sql
ALTER TABLE tb_category
ADD COLUMN search tsvector;

DROP INDEX IF EXISTS categories_fts;
CREATE INDEX categories_fts ON tb_category USING GIN(search);
```

---

<table>
  <tr>
      <th>Index</th>
      <td><strong>IDX11</strong></td>
  </tr>
  <tr>
      <th>Related Queries</th>
      <td>SELECT26</td>
  </tr>
  <tr>
      <th>Relation</th>
      <td>tb_member</td>
  </tr>
  <tr>
      <th>Attribute</th>
      <td>search</td>
  </tr>
  <tr>
      <th>Type</th>
      <td>GIN</td>
  </tr>
  <tr>
      <th>Clustering</th>
      <td>No</td>
  </tr>
  <tr>
      <th>Justification</th>
      <td>Query SELECT26 is used to search members given by a user's input (FTS). It's executed many times so it has to be fast. It's a GIN because the referred tuple won't be updated that frequently. This way we make searches fast. No clustering needed because the search has high cardinality.</td>
  </tr>
</table>

```sql
ALTER TABLE tb_member
ADD COLUMN search tsvector;

DROP INDEX IF EXISTS users_fts;
CREATE INDEX users_fts ON tb_member USING GIN(search);
```

---

<table>
  <tr>
      <th>Index</th>
      <td><strong>IDX12</strong></td>
  </tr>
  <tr>
      <th>Related Queries</th>
      <td>SELECT24</td>
  </tr>
  <tr>
      <th>Relation</th>
      <td>tb_recipe</td>
  </tr>
  <tr>
      <th>Attribute</th>
      <td>search</td>
  </tr>
  <tr>
      <th>Type</th>
      <td>GIN</td>
  </tr>
  <tr>
      <th>Clustering</th>
      <td>No</td>
  </tr>
  <tr>
      <th>Justification</th>
      <td>Query SELECT24 is used to search recipes given by a user's input (FTS). It's executed many times so it has to be fast. It's a GIN because the referred tuple won't be updated that frequently. This way we make searches fast. No clustering needed because the search has high cardinality.</td>
  </tr>
</table>

```sql
ALTER TABLE tb_recipe
ADD COLUMN search tsvector;

DROP INDEX IF EXISTS recipes_fts;
CREATE INDEX recipes_fts ON recipes_fts_view USING GIN(search);
```

---

<table>
  <tr>
      <th>Index</th>
      <td><strong>IDX13</strong></td>
  </tr>
  <tr>
      <th>Related Queries</th>
      <td>SELECT27</td>
  </tr>
  <tr>
      <th>Relation</th>
      <td>tb_group</td>
  </tr>
  <tr>
      <th>Attribute</th>
      <td>search</td>
  </tr>
  <tr>
      <th>Type</th>
      <td>GIN</td>
  </tr>
  <tr>
      <th>Clustering</th>
      <td>No</td>
  </tr>
  <tr>
      <th>Justification</th>
      <td>Query SELECT27 is used to search groups given by a user's input (FTS). It's executed many times so it has to be fast. It's a GIN because the referred tuple won't be updated that frequently. This way we make searches fast. No clustering needed because the search has high cardinality.</td>
  </tr>
</table>

```sql
ALTER TABLE tb_group
ADD COLUMN search tsvector;

DROP INDEX IF EXISTS groups_fts;
CREATE INDEX groups_fts ON tb_group USING GIN(search);
```

---

### 3. Triggers and User-defined Functions

<!--#### User defined function for calculating comment elapsed time (should this go in triggers/udf section?)-->
<table>
  <tr>
      <th>User-Defined Function</th>
      <td><strong>UDF01</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>This user-defined function outputs human-friendly text with the elapsed time since the given 'timestamptz'.</td>
  </tr>
</table>

```sql
DROP FUNCTION IF EXISTS comment_elapsed_time(timestamptz) CASCADE;
CREATE OR REPLACE FUNCTION comment_elapsed_time(comment_creation_time timestamptz)
RETURNS TEXT AS $timeString$ 
DECLARE 
    time_unit INTEGER;
BEGIN
    -- Year
	SELECT EXTRACT(YEAR FROM AGE(now(), comment_creation_time)) INTO time_unit;
   	IF time_unit > 0 THEN
        IF time_unit > 1 THEN
            RETURN CONCAT(time_unit, ' years ago');
        ELSE
            RETURN CONCAT(time_unit, ' year ago');
        END IF;
    END IF;
    
    -- Months
	SELECT EXTRACT(MONTH FROM AGE(now(), comment_creation_time)) INTO time_unit;
	IF time_unit > 0 THEN
        IF time_unit > 1 THEN
            RETURN CONCAT(time_unit, ' months ago');
        ELSE
            RETURN CONCAT(time_unit, ' month ago');
        END IF;
    END IF;

    -- Days
	SELECT EXTRACT(DAY FROM AGE(now(), comment_creation_time)) INTO time_unit;
    IF time_unit > 0 THEN
        IF time_unit > 1 THEN
            RETURN CONCAT(time_unit, ' days ago');
        ELSE
            RETURN CONCAT(time_unit, ' day ago');
        END IF;
    END IF;

    -- Hours
	SELECT EXTRACT(HOUR FROM AGE(now(), comment_creation_time)) INTO time_unit;
    IF time_unit > 0 THEN
        IF time_unit > 1 THEN
            RETURN CONCAT(time_unit, ' hours ago');
        ELSE
            RETURN CONCAT(time_unit, ' hour ago');
        END IF;
    END IF;

    -- Minutes
	SELECT EXTRACT(MINUTE FROM AGE(now(), comment_creation_time)) INTO time_unit;
    IF time_unit > 0 THEN
        IF time_unit > 1 THEN
            RETURN CONCAT(time_unit, ' minutes ago');
        ELSE
            RETURN CONCAT(time_unit, ' minute ago');
        END IF;
    END IF;

    -- Seconds
	SELECT EXTRACT(SECOND FROM AGE(now(), comment_creation_time)) INTO time_unit;
    IF time_unit > 0 THEN
        IF time_unit > 1 THEN
            RETURN CONCAT(time_unit, ' seconds ago');
        ELSE
            RETURN CONCAT(time_unit, ' second ago');
        END IF;
    END IF;

    RETURN time_unit;
END;
$timeString$ LANGUAGE plpgsql;
```

<table>
  <tr>
      <th>User-Defined Function</th>
      <td><strong>UDF02</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>This user-defined function will be used in Laravel to refresh the Materialized View regarding recipes' FTS. It will be a cron job.</td>
  </tr>
</table>

```sql
DROP MATERIALIZED VIEW IF EXISTS recipes_fts_view;
CREATE MATERIALIZED VIEW recipes_fts_view AS
    SELECT tb_recipe.id AS recipe_id , tb_recipe.name AS recipe_name, tb_member.id AS member_id, tb_member.name AS member_name,
        tb_category.name AS category, string_agg(tb_tag.name, ' ') AS tag,
        (setweight(to_tsvector('english', tb_recipe.name), 'A') ||
        setweight(to_tsvector('english', tb_category.name), 'B') ||
        setweight(to_tsvector('english', string_agg(tb_tag.name, ' ')), 'B') ||
        setweight(to_tsvector('simple', tb_member.name), 'C')) AS search
    FROM tb_recipe
    JOIN tb_member ON tb_recipe.id_member = tb_member.id
    JOIN tb_category ON tb_recipe.id_category = tb_category.id
    JOIN tb_tag_recipe ON tb_recipe.id = tb_tag_recipe.id_recipe
    JOIN tb_tag ON tb_tag_recipe.id_tag = tb_tag.id
    GROUP BY tb_recipe.id, tb_member.id, tb_category.name
    ORDER BY tb_recipe.id;

-- We will have a Laravel cron job to execute this UDF.
DROP FUNCTION IF EXISTS recipes_fts_UDF() CASCADE;
CREATE OR REPLACE FUNCTION recipes_fts_UDF() 
RETURNS void AS $$
BEGIN
    REFRESH MATERIALIZED VIEW recipes_fts_view;
END
$$ LANGUAGE plpgsql;
```

---

<table>
  <tr>
      <th>User-Defined Function</th>
      <td><strong>UDF03</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>This user-defined function will check if a recipe is visible.</td>
  </tr>
</table>

```sql
DROP FUNCTION IF EXISTS recipe_visibility();
CREATE OR REPLACE FUNCTION recipe_visibility(id_recipe integer, id_user integer)
RETURNS BOOLEAN AS $$ 
DECLARE 
    _id_group integer;
    group_visibility boolean;
    author_visibility boolean;
    id_author integer;
BEGIN
    SELECT tb_recipe.id_group INTO _id_group
    FROM tb_recipe 
    WHERE tb_recipe.id = id_recipe;
	
	-- Recipe belongs to a group and the group is public or the user is a member of that group
    IF _id_group IS NOT NULL THEN
        SELECT visibility INTO group_visibility FROM tb_group;
        IF group_visibility = TRUE THEN
            RETURN TRUE;
        END IF; 
        IF EXISTS(
            SELECT * FROM tb_group_member 
            WHERE tb_group_member.id_group = _id_group AND tb_group_member.id_member = id_user) THEN
            RETURN TRUE;
        END IF;
    END IF;

    SELECT tb_member.visibility INTO author_visibility
    FROM tb_recipe
    JOIN tb_member ON tb_recipe.id_member = tb_member.id
    WHERE tb_recipe.id = id_recipe;

    SELECT tb_recipe.id_member INTO id_author
    FROM tb_recipe
    JOIN tb_member ON tb_recipe.id_member = tb_member.id
    WHERE tb_recipe.id = id_recipe;
	
	-- Recipe's author profile visibility if public
    IF author_visibility = TRUE THEN
        RETURN TRUE;
    END IF;
	
	-- User follows recipe's author
    IF EXISTS (
        SELECT * FROM tb_following
        WHERE tb_following.id_following = id_user AND tb_following.id_followed = id_author
        AND state = 'accepted') THEN
        RETURN TRUE;
    END IF;

	-- User is the recipe's creator
	IF id_author = id_user THEN
		RETURN TRUE;
	END IF;

    RETURN FALSE;
END;
$$ LANGUAGE plpgsql;
```

---

<table>
  <tr>
      <th>Trigger</th>
      <td><strong>TRIGGER01</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>An user can only rate a recipe once. This trigger raises an exception if that rule is being broken by the update or insertion of a comment or review.</td>
  </tr>
</table>

```sql
CREATE OR REPLACE FUNCTION single_rating() RETURNS TRIGGER AS $$
BEGIN
    IF NEW.rating IS NOT NULL AND EXISTS (
            SELECT FROM tb_comment 
            WHERE id_recipe = NEW.id_recipe 
                AND id_member = NEW.id_member 
                AND rating IS NOT NULL 
                AND id != NEW.id   -- the id may be equal in case of update
    ) THEN
        RAISE EXCEPTION 'A user can only rate a recipe once.';
    END IF; 
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS single_rating_tg ON tb_comment;
CREATE TRIGGER single_rating_tg
BEFORE INSERT OR UPDATE ON tb_comment
FOR EACH ROW
EXECUTE PROCEDURE single_rating();
```

---

<table>
  <tr>
      <th>Trigger</th>
      <td><strong>TRIGGER02</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>The date of a comment or review must be after the post's creation date. This trigger raises an exception if that rule is being broken by the update or insertion of a comment or review.</td>
  </tr>
</table>

```sql
CREATE OR REPLACE FUNCTION comment_date_precedence() RETURNS TRIGGER AS $$
DECLARE
    recipe_time timestamptz := (SELECT creation_time FROM tb_recipe WHERE id = NEW.id_recipe);
BEGIN
    IF NEW.post_time IS NOT NULL AND NEW.post_time < recipe_time THEN
        RAISE EXCEPTION 'The date/time of a comment/review must be after the recipe''s creation date. Comment id = (%)', NEW.id;
    END IF; 
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS comment_date_precedence_tg ON tb_comment;
CREATE TRIGGER comment_date_precedence_tg
BEFORE INSERT OR UPDATE ON tb_comment
FOR EACH ROW
EXECUTE PROCEDURE comment_date_precedence();
```

---

<table>
  <tr>
      <th>Trigger</th>
      <td><strong>TRIGGER03</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>The date of an answer must be after the comment's creation date. This trigger raises an exception if that rule is being broken by the update or insertion of an answer.</td>
  </tr>
</table>

```sql
CREATE OR REPLACE FUNCTION answer_date_precedence() RETURNS TRIGGER AS $$
DECLARE
    original_comment_time timestamptz := (SELECT post_time FROM tb_comment WHERE id = NEW.father_comment);
    answer_time timestamptz := (SELECT post_time FROM tb_comment WHERE id = NEW.id_comment);
BEGIN
    IF answer_time < original_comment_time THEN
        RAISE EXCEPTION 'The date/time of an answer must be after the original comment''s creation date. Comment id = (%), answer id = (%)', NEW.father_comment, NEW.id_comment;
    END IF; 
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS answer_date_precedence_tg ON tb_answer;
CREATE TRIGGER answer_date_precedence_tg
BEFORE INSERT OR UPDATE ON tb_answer
FOR EACH ROW
EXECUTE PROCEDURE answer_date_precedence();
```

---

<table>
  <tr>
      <th>Trigger</th>
      <td><strong>TRIGGER04</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>The default value for the following state depends on the member's visibility. This trigger modifies the value of the 'state' field of an insertion to enforce that.</td>
  </tr>
</table>

```sql
CREATE OR REPLACE FUNCTION default_following_state() RETURNS TRIGGER AS $$
DECLARE
    member_visibility boolean := (SELECT visibility FROM tb_member WHERE id = NEW.id_followed);
BEGIN
    IF NEW.state IS NULL THEN
        IF member_visibility = TRUE THEN  -- if the member's profile is public
            NEW.state := 'accepted';
        ELSE
            NEW.state := 'pending';
        END IF; 
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS default_following_state_tg ON tb_following;
CREATE TRIGGER default_following_state_tg
BEFORE INSERT ON tb_following
FOR EACH ROW
EXECUTE PROCEDURE default_following_state();
```

---

<table>
  <tr>
      <th>Trigger</th>
      <td><strong>TRIGGER05</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>This trigger procedure makes sure that the field 'search', which is a 'ts_vector', of the new row is up to date.</td>
  </tr>
</table>

```sql
CREATE OR REPLACE FUNCTION name_search() RETURNS TRIGGER AS $$
DECLARE
    idiom regconfig := TG_ARGV[0];
BEGIN
    NEW.search = to_tsvector(idiom, NEW.name);
    RETURN NEW;
END
$$ LANGUAGE plpgsql;
```

---

<table>
  <tr>
      <th>Trigger</th>
      <td><strong>TRIGGER06</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>This trigger executes the TRIGGER05 procedure to an insertion or update on 'tb_category'.</td>
  </tr>
</table>

```sql
DROP TRIGGER IF EXISTS category_search_tg ON tb_category;
CREATE TRIGGER category_search_tg
BEFORE INSERT OR UPDATE OF name ON tb_category
FOR EACH ROW
EXECUTE PROCEDURE name_search('english');
```

---

<table>
  <tr>
      <th>Trigger</th>
      <td><strong>TRIGGER07</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>This trigger executes the TRIGGER05 procedure to an insertion or update on 'tb_member'.</td>
  </tr>
</table>

```sql
DROP TRIGGER IF EXISTS users_search_tg ON tb_member;
CREATE TRIGGER users_search_tg
BEFORE INSERT OR UPDATE OF name ON tb_member
FOR EACH ROW
EXECUTE PROCEDURE name_search('simple');
```

---

<table>
  <tr>
      <th>Trigger</th>
      <td><strong>TRIGGER08</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>This trigger executes the TRIGGER05 procedure to an insertion or update on 'tb_group'.</td>
  </tr>
</table>

```sql
DROP TRIGGER IF EXISTS groups_search_tg ON tb_group;
CREATE TRIGGER groups_search_tg
BEFORE INSERT OR UPDATE OF name ON tb_group
FOR EACH ROW
EXECUTE PROCEDURE name_search('english');
```

---

<table>
  <tr>
      <th>Trigger</th>
      <td><strong>TRIGGER09</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>This trigger is used to update a recipe's score upon insert or update of a review's rating.</td>
  </tr>
</table>

```sql
DROP FUNCTION IF EXISTS score_recipe_insert_update() CASCADE;
CREATE FUNCTION score_recipe_insert_update() RETURNS TRIGGER AS $$
DECLARE 
    totalScore real;
BEGIN
    SELECT score * num_rating INTO totalScore
    FROM tb_recipe
    WHERE id = NEW.id_recipe;

    IF TG_OP = 'INSERT' THEN
        UPDATE tb_recipe 
        SET num_rating = num_rating + 1, score = (totalScore + NEW.rating) / (num_rating + 1)
        WHERE tb_recipe.id = NEW.id_recipe;
    END IF;
    IF TG_OP = 'UPDATE' THEN
        UPDATE tb_recipe 
        SET score = (totalScore + (NEW.rating - OLD.rating)) / num_rating
        WHERE tb_recipe.id = NEW.id_recipe;
    END IF;

    RETURN NEW;
END
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS score_recipe_insert_update_tg ON tb_comment;
CREATE TRIGGER score_recipe_insert_update_tg
AFTER INSERT OR UPDATE OF rating ON tb_comment
FOR EACH ROW
WHEN (NEW.rating IS NOT NULL)
EXECUTE PROCEDURE score_recipe_insert_update();
```

---

<table>
  <tr>
      <th>Trigger</th>
      <td><strong>TRIGGER10</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>This trigger is used to update a recipe's score upon deletion of a review.</td>
  </tr>
</table>

```sql
DROP FUNCTION IF EXISTS score_recipe_delete() CASCADE;
CREATE FUNCTION score_recipe_delete() RETURNS TRIGGER AS $$
DECLARE
    totalScore real;
BEGIN
    SELECT score * num_rating INTO totalScore
    FROM tb_recipe
    WHERE id = OLD.id_recipe;

    UPDATE tb_recipe
    SET num_rating = num_rating - 1, score = (totalScore - OLD.rating) / (num_rating - 1)
    WHERE tb_recipe.id = OLD.id_recipe;

    RETURN OLD;    
END
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS score_recipe_delete_tg ON tb_comment;
CREATE TRIGGER score_recipe_delete_tg
AFTER DELETE ON tb_comment
FOR EACH ROW
WHEN (OLD.rating IS NOT NULL)
EXECUTE PROCEDURE score_recipe_delete();
```

---

<table>
  <tr>
      <th>Trigger</th>
      <td><strong>TRIGGER11</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>This trigger is used to update a user's score upon insert of a recipe.</td>
  </tr>
</table>

```sql
DROP FUNCTION IF EXISTS score_member_insert() CASCADE;
CREATE FUNCTION score_member_insert() RETURNS TRIGGER AS $$
BEGIN
    UPDATE tb_member 
    SET num_rating = num_rating + 1
    WHERE tb_member.id = NEW.id_member;

    RETURN NEW;
END
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS score_member_insert_tg ON tb_recipe;
CREATE TRIGGER score_member_insert_tg
AFTER INSERT ON tb_recipe
FOR EACH ROW
EXECUTE PROCEDURE score_member_insert();
```

---

<table>
  <tr>
      <th>Trigger</th>
      <td><strong>TRIGGER12</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>This trigger is used to update a user's score upon update of a recipe's score.</td>
  </tr>
</table>

```sql
DROP FUNCTION IF EXISTS score_member_update() CASCADE;
CREATE FUNCTION score_member_update() RETURNS TRIGGER AS $$
DECLARE
    totalScore real;
BEGIN
    SELECT score * num_rating INTO totalScore
    FROM tb_member
    WHERE id = NEW.id_member;

    UPDATE tb_member 
    SET score = (totalScore + (NEW.score - OLD.score)) / num_rating
    WHERE tb_member.id = NEW.id_member;

    RETURN NEW;
END
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS score_member_update_tg ON tb_recipe;
CREATE TRIGGER score_member_update_tg
AFTER UPDATE OF score ON tb_recipe
FOR EACH ROW
EXECUTE PROCEDURE score_member_update();
```

<table>
  <tr>
      <th>Trigger</th>
      <td><strong>TRIGGER13</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>This trigger is used to update a user's score upon delete of a recipe.</td>
  </tr>
</table>

```sql
DROP FUNCTION IF EXISTS score_member_delete() CASCADE;
CREATE FUNCTION score_member_delete() RETURNS TRIGGER AS $$
DECLARE
    totalScore real;
BEGIN
    SELECT score * num_rating INTO totalScore
    FROM tb_member
    WHERE id = OLD.id_member;

    UPDATE tb_member
    SET num_rating = num_rating - 1, score = (totalScore - OLD.score) / (num_rating - 1)
    WHERE tb_member.id = OLD.id_member;

    RETURN OLD;    
END
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS score_member_delete_tg ON tb_recipe;
CREATE TRIGGER score_member_delete_tg
AFTER DELETE ON tb_recipe
FOR EACH ROW
EXECUTE PROCEDURE score_member_delete();
```

<table>
  <tr>
      <th>Trigger</th>
      <td><strong>TRIGGER14</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>This trigger is used to confirm that answers cannot have ratings.</td>
  </tr>
</table>

```sql
DROP FUNCTION IF EXISTS answer_rating() CASCADE;
CREATE FUNCTION answer_rating() RETURNS TRIGGER AS
$BODY$
DECLARE
    comment_rating integer := (SELECT rating FROM tb_comment WHERE id = NEW.id_comment);
BEGIN
    IF comment_rating IS NOT NULL THEN
        RAISE EXCEPTION 'An answer cannot have a rating.';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS answer_rating_tg ON tb_answer;
CREATE TRIGGER answer_rating_tg
    BEFORE INSERT OR UPDATE ON tb_answer
    FOR EACH ROW
    EXECUTE PROCEDURE answer_rating();
```

<table>
  <tr>
      <th>Trigger</th>
      <td><strong>TRIGGER15</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>This trigger is used to verify if the request for group membership is accepted automatically if the group is public or is pending otherwise.</td>
  </tr>
</table>

```sql
DROP FUNCTION IF EXISTS group_request() CASCADE;
CREATE FUNCTION group_request() RETURNS TRIGGER AS
$BODY$
DECLARE
    group_visibility boolean := (SELECT visibility FROM tb_group WHERE id = NEW.id_group);
BEGIN
    IF group_visibility = TRUE THEN
        NEW.state := 'accepted';
    ELSE
        NEW.state := 'pending';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS group_request_tg ON tb_group_request;
CREATE TRIGGER group_request_tg
    BEFORE INSERT OR UPDATE ON tb_group_request
    FOR EACH ROW
    EXECUTE PROCEDURE group_request();
```

<table>
  <tr>
      <th>Trigger</th>
      <td><strong>TRIGGER16</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>This trigger is used to add a comment notification after a comment is inserted.</td>
  </tr>
</table>

```sql
DROP FUNCTION IF EXISTS add_comment_notification CASCADE;
CREATE FUNCTION add_comment_notification() RETURNS TRIGGER AS
$BODY$
BEGIN
    INSERT INTO tb_comment_notification (id_comment) VALUES (NEW.id);
	RETURN NEW;
END;
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS comment_notification ON tb_comment_notification CASCADE;
CREATE TRIGGER comment_notification
    AFTER INSERT ON tb_comment
    FOR EACH ROW
    EXECUTE PROCEDURE add_comment_notification();
```

<table>
  <tr>
      <th>Trigger</th>
      <td><strong>TRIGGER17</strong></td>
  </tr>
  <tr>
      <th>Description</th>
      <td>This trigger is used to add a favourite notification after a user adds a recipe to the favourites.</td>
  </tr>
</table>

```sql
DROP FUNCTION IF EXISTS add_favourite_notification CASCADE;
CREATE FUNCTION add_favourite_notification() RETURNS TRIGGER AS
$BODY$
BEGIN
    INSERT INTO tb_favourite_notification (id_caused_by, id_recipe)
    VALUES (NEW.id_member, NEW.id_recipe);
    RETURN NEW;
END;
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS favourite_notification ON tb_favourite_notification CASCADE;
CREATE TRIGGER favourite_notification
    AFTER INSERT ON tb_favourite
    FOR EACH ROW
    EXECUTE PROCEDURE add_favourite_notification();
```

### 4. Transactions

<table>
  <tr>
      <th>T01</th>
      <td>Create recipe</td>
  </tr>
  <tr>
      <th>Justification</th>
      <td>The recipe creation should be all or nothing, as we cannot have the recipe's steps, tags or ingredients being partially inserted. In this case, the isolation level doesn't have much importance, because we are only inserting.</td>
  </tr>
  <tr>
      <th>Isolation Level</th>
      <td>READ COMMITTED</td>
  </tr>
</table>

```sql
SET TRANSACTION ISOLATION LEVEL READ COMMITTED;
BEGIN TRANSACTION;

INSERT INTO tb_recipe (name, difficulty, description, servings, preparation_time, cooking_time, additional_time, visibility, creation_time, id_member, id_category)
VALUES ($title, $difficulty, $description, $servings, $preparation_time, $cooking_time, $additional_time, $visibility, $creation_time, $id_member, $id_category);

INSERT INTO tb_step (name, description, id_recipe) VALUES ($step_name, $step_description, $id_recipe);  -- this tag is repeated for each step

INSERT INTO tb_tag_recipe (id_tag, id_recipe) VALUES ($id_tag, $id_recipe);  -- this line is repeated for each tag

INSERT INTO tb_ingredient_recipe (id_recipe, id_ingredient, id_unit, quantity) VALUES ($id_recipe, $id_ingredient, $id_unit, $quantity); -- this line is repeated for each ingredient

COMMIT;
```

---

<table>
  <tr>
      <th>T02</th>
      <td>Reply to comment</td>
  </tr>
  <tr>
      <th>Justification</th>
      <td>The answer insertion must be all or nothing because we don't want to insert the new comment (which the answer) and then not have it linked with its parent, which would result in it being treated as if it was a regular comment. In this case, the isolation level doesn't have much importance, because we are only inserting.</td>
  </tr>
  <tr>
      <th>Isolation Level</th>
      <td>READ COMMITTED</td>
  </tr>
</table>

```sql
SET TRANSACTION ISOLATION LEVEL READ COMMITTED;
BEGIN TRANSACTION;

WITH new_comment AS (
    INSERT INTO tb_comment (text, rating, id_member, id_recipe) 
        VALUES ($text, NULL, $id_member, $id_recipe) RETURNING id AS new_comment_id
)
INSERT INTO tb_answer (id_comment, father_comment) SELECT new_comment_id AS id_comment, $father_comment as father_comment FROM new_comment;

COMMIT;
```

---

<table>
  <tr>
      <th>T03</th>
      <td>Update recipe</td>
  </tr>
  <tr>
      <th>Justification</th>
      <td>Updating a recipe must be an all or nothing operation because we don't want to have the recipe be partially altered, which would render it invalid. In this case, the isolation level doesn't have much importance, because we are only inserting.</td>
  </tr>
  <tr>
      <th>Isolation Level</th>
      <td>READ COMMITTED</td>
  </tr>
</table>

```sql
SET TRANSACTION ISOLATION LEVEL READ COMMITTED;
BEGIN TRANSACTION;

UPDATE tb_recipe
SET difficulty = $difficulty, description = $description, servings = $servings, preparation_time = $preparation_time, 
cooking_time = $cooking_time, additional_time = $additional_time, 
visibility = $visibility, id_category = $category
WHERE id = $id_recipe;

INSERT INTO tb_step (name, description, id_recipe) VALUES ($step_name, $step_description, $id_recipe);  -- may need to add steps, may be repeated as necessary

UPDATE tb_step   -- may need to update steps, may be repeated as necessary
SET name = $new_step_name, description = $new_step_description  
WHERE id = $id_step_to_update;

DELETE FROM tb_step WHERE id = $id_step_to_delete; -- may need to delete steps, may be repeated as necessary

INSERT INTO tb_tag_recipe (id_tag, id_recipe) VALUES ($id_tag, $id_recipe);  -- may need to add tags, may be repeated as necessary

DELETE FROM tb_tag_recipe WHERE id_tag = $id_tag_to_delete AND id_recipe = $id_recipe;  -- may need to remove tags, may be repeated as necessary

INSERT INTO tb_ingredient_recipe (id_recipe, id_ingredient, id_unit, quantity) VALUES ($id_recipe, $id_ingredient, $id_unit, $quantity); -- may need to add ingredients, may be repeated as necessary

UPDATE tb_ingredient_recipe  -- may need to update recipe ingredients, may be repeated as necessary
SET id_unit = $new_id_unit, quantity = $new_quantity
WHERE id_recipe = $id_recipe AND id_ingredient = $id_ingredient_to_update;

DELETE FROM tb_ingredient_recipe WHERE id_recipe = $id_recipe AND id_ingredient = $id_ingredient_to_delete;   -- may need to delete ingredients, may be repeated as necessary

COMMIT;
```

---

<table>
  <tr>
      <th>T04</th>
      <td>Member Information</td>
  </tr>
  <tr>
      <th>Justification</th>
      <td>In a transaction the insertion of new rows in the tables related to the member (tb_following, tg_group_member, tb_recipe and tb_category) information can happen, which will imply that the information retrieved in the remaining selects is different, consequently resulting in a Phantom Read. It's READ ONLY because it only uses selects.</td>
  </tr>
  <tr>
      <th>Isolation Level</th>
      <td>SERIALIZABLE READ ONLY</td>
  </tr>
</table>

```sql
SET TRANSACTION ISOLATION LEVEL SERIALIZABLE READ ONLY;
BEGIN TRANSACTION;

SELECT tb_member.name, tb_member.username, tb_member.city, tb_member.bio, coalesce(tb_member.score, 0) AS score, tb_country.name AS country,
(SELECT COUNT(*) FROM tb_recipe WHERE id_member = tb_member.id) AS number_recipes,
(SELECT COUNT(*) FROM tb_following WHERE id_following = tb_member.id) AS number_following,
(SELECT COUNT(*) FROM tb_following WHERE id_followed = tb_member.id) AS number_followed
FROM tb_member
JOIN tb_country ON tb_member.id_country = tb_country.id
WHERE tb_member.id = $userId; -- $userId

-- Users following (Profile)

SELECT tb_following.id_followed 
FROM tb_following
WHERE tb_following.id_following = $userId; -- $userId

-- User Groups (Profile)

SELECT tb_group.id, tb_group.name
FROM tb_group_member
JOIN tb_group ON tb_group_member.id_group = tb_group.id
WHERE tb_group_member.id_member = $userId; -- $userId

-- Member Recipes 

SELECT tb_recipe.id, tb_recipe.name, tb_recipe.description, tb_recipe.servings, 
    tb_recipe.preparation_time, tb_recipe.cooking_time, tb_recipe.additional_time,
    tb_recipe.creation_time, recipe_visibility(tb_recipe.id, $userId) AS visibility,
    tb_category.name AS category, score,
    comment_elapsed_time(tb_recipe.creation_time) as elapsed_time  
FROM tb_recipe JOIN tb_category ON tb_recipe.id_category = tb_category.id
WHERE id_member = $userId AND id_group IS NULL; 

COMMIT;
```

---

<table>
  <tr>
      <th>T05</th>
      <td>Recipe Information</td>
  </tr>
  <tr>
      <th>Justification</th>
      <td>In a transaction the insertion of new rows in the tables related to the recipe (tb_tags, tb_ingredients, tb_steps, tb_recipe, tb_comment, etc.) information can happen, which will imply that the information retrieved in the remaining selects is different, consequently resulting in a Phantom Read. It's READ ONLY because it only uses selects.</td>
  </tr>
  <tr>
      <th>Isolation Level</th>
      <td>SERIALIZABLE READ ONLY</td>
  </tr>
</table>

```sql
SET TRANSACTION ISOLATION LEVEL SERIALIZABLE READ ONLY;
BEGIN TRANSACTION;

SELECT tb_recipe.name, tb_recipe.description, tb_recipe.servings, tb_recipe.preparation_time, tb_recipe.cooking_time, tb_recipe.additional_time,
    tb_recipe.creation_time, score, tb_member.name AS member_name, tb_member.username AS member_username, tb_category.name AS category,
    (SELECT COUNT(*) FROM tb_comment WHERE id_recipe = tb_recipe.id AND rating IS NOT NULL) AS number_ratings,
FROM tb_recipe
JOIN tb_member ON tb_recipe.id_member = tb_member.id
JOIN tb_category ON tb_recipe.id_category = tb_category.id
WHERE recipe_visibility(tb_recipe.id, $userId) = TRUE AND tb_recipe.id = $recipeId; -- $userId | $recipeId

-- Tags

SELECT tb_tag.id, tb_tag.name
FROM tb_tag_recipe
JOIN tb_recipe ON tb_tag_recipe.id_recipe = tb_recipe.id
JOIN tb_tag ON tb_tag_recipe.id_tag = tb_tag.id
WHERE tb_recipe.id = $recipeId; -- $recipeId

-- Ingredients

SELECT tb_ingredient.id, tb_ingredient.name, tb_ingredient_recipe.quantity, tb_unit.name
FROM tb_ingredient_recipe
JOIN tb_recipe ON tb_ingredient_recipe.id_recipe = tb_recipe.id
JOIN tb_ingredient ON tb_ingredient_recipe.id_ingredient = tb_ingredient.id
JOIN tb_unit ON tb_ingredient_recipe.id_unit = tb_unit.id
WHERE tb_recipe.id = $recipeId; -- $recipeId

-- Steps

SELECT tb_step.id, tb_step.name, tb_step.description
FROM tb_step
JOIN tb_recipe ON tb_step.id_recipe = tb_recipe.id
WHERE tb_recipe.id = $recipeId; -- $recipeId

-- Note: Need to execute first the comment_elapsed_time UDF.

-- Comments

SELECT tb_comment.id, tb_comment.text, comment_elapsed_time(tb_comment.post_time), tb_answer.father_comment, tb_member.name, tb_member.id
FROM tb_comment
JOIN tb_answer ON tb_comment.id = tb_answer.id_comment
JOIN tb_member ON tb_comment.id_member = tb_member.id
WHERE tb_comment.id_recipe = $recipeId; -- $recipeId

-- Reviews

SELECT tb_comment.id, tb_comment.text, tb_comment.rating, comment_elapsed_time(tb_comment.post_time)
FROM tb_comment
JOIN tb_recipe ON tb_comment.id = tb_recipe.id
WHERE tb_comment.rating IS NOT NULL AND tb_recipe.id = $recipeId; -- $recipeId


COMMIT;
```

---

<table>
  <tr>
      <th>T06</th>
      <td>Group Member Acceptance</td>
  </tr>
  <tr>
      <th>Justification</th>
      <td>This transactions exists to update the request of a member when they are inserted in the group.</td>
  </tr>
  <tr>
      <th>Isolation Level</th>
      <td>READ COMMITTED</td>
  </tr>
</table>

```sql
SET TRANSACTION ISOLATION LEVEL READ COMMITTED;
BEGIN TRANSACTION;

-- Insert into group member
INSERT INTO tb_group_member (id_member, id_group)
    VALUES ($id_member, $id_group);

-- Change group request to accepted
UPDATE tb_group_request
    SET state = 'accepted'
    WHERE id_member = $id_member AND id_group = $id_group;

COMMIT;
```

<table>
  <tr>
      <th>T07</th>
      <td>Get group information</td>
  </tr>
  <tr>
      <th>Justification</th>
      <td>This transaction exists to get all the information of a group. It's READ ONLY because it only uses selects.</td>
  </tr>
  <tr>
      <th>Isolation Level</th>
      <td>SERIALIZABLE READ ONLY</td>
  </tr>
</table>

```sql
SET TRANSACTION ISOLATION LEVEL SERIALIZABLE READ ONLY;
BEGIN TRANSACTION;

-- Group Information 

SELECT tb_group.name, tb_group.description
FROM tb_group
WHERE tb_group.id = $groupId; -- $groupId

-- Members

SELECT tb_member.id, tb_member.username
FROM tb_group_member
JOIN tb_member ON tb_group_member.id_member = tb_member.id
WHERE tb_group_member.id_group = $groupId; -- $groupId

-- Group Requests

SELECT tb_group_request.state, tb_member.id, tb_member.name, tb_member.username
FROM tb_group_request
JOIN tb_member ON tb_group_request.id_member = tb_member.id
WHERE tb_group = $groupId; -- $groupId

-- Group recipes

SELECT tb_recipe.id, tb_recipe.name, tb_recipe.description, tb_recipe.servings, 
    tb_recipe.preparation_time, tb_recipe.cooking_time, tb_recipe.additional_time,
    tb_recipe.creation_time, 
    tb_category.name AS category, coalesce(tb_recipe.score, 0) as score, 
	comment_elapsed_time(tb_recipe.creation_time) as elapsed_time

FROM tb_recipe JOIN tb_category ON tb_recipe.id_category = tb_category.id

WHERE id_group = $id_group;


COMMIT;
```

### 5. Complete SQL Code

#### 5.1. Database schema

The database schema script can be consulted [here](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/blob/master/ebd/schema.pgsql).

#### 5.2. Database population

The database population script can be consulted [here](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/blob/master/ebd/populate.pgsql).

#### 5.3. After Populate

The script to be executed after the database population script can be consulted [here](https://git.fe.up.pt/lbaw/lbaw2021/lbaw2135/-/blob/master/ebd/afterPopulate.pgsql).

---

## Revision history

No changes made after the first submission.

---

GROUP2135, 09/04/21

Alexandre Abreu, up201800168@fe.up.pt (Editor)

Rafael Cristino, up201806680@fe.up.pt

Rui Pinto, up201806441@fe.up.pt

Tiago Gomes, up201806658@fe.up.pt