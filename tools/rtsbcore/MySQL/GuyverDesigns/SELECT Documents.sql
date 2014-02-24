SELECT documents_types.sdesc,
 documents_headlines.title, documents_headlines.headline0,
 documents_headlines.headline1, documents_headlines.headline2,
 documents.content
FROM documents
JOIN documents_headlines on documents_headlines.object_uid = documents.uid
JOIN documents_types ON documents_types.uid = documents_headlines.documents_types_uid
;


