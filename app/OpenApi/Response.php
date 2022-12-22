$response = Schema::object()->properties(
Schema::string('message')->example('The given data was invalid.'),
Schema::object('errors')
->additionalProperties(
Schema::array()->items(Schema::string())
)
->example(['field' => ['Something is wrong with this field!']])
);