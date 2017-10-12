@extends('layouts.guest')

@section('content')
  <vue-questionnaire :data-range='[
  {
    "section": "IDENTIFICACIÓN",
    "questions": [
      {
        "statement": "Apellidos",
        "type": "text",
        "answer": "Chunqui"
      },
      {
        "statement": "Nombres",
        "type": "text",
        "answer": ""
      },
      {
        "statement": "Código",
        "type": "text",
        "answer": ""
      },
      {
        "statement": "Especialidad",
        "type": "text",
        "answer": ""
      },
      {
        "statement": "Ciclo Relativo",
        "type": "select",
        "options": [
          {
            "text": "1",
            "value": "1"
          },
          {
            "text": "2",
            "value": "2"
          },
          {
            "text": "3",
            "value": "3"
          },
          {
            "text": "4",
            "value": "4"
          },
          {
            "text": "5",
            "value": "5"
          },
          {
            "text": "6",
            "value": "6"
          },
          {
            "text": "7",
            "value": "7"
          },
          {
            "text": "8",
            "value": "8"
          },
          {
            "text": "9",
            "value": "9"
          },
          {
            "text": "10",
            "value": "10"
          }
        ],
        "answer": ""
      },
      {
        "statement": "Edad",
        "type": "number",
        "answer": ""
      },
      {
        "statement": "Teléfono (casa/trabajo)",
        "type": "number",
        "answer": ""
      },
      {
        "statement": "Teléfono Celular",
        "type": "number",
        "answer": ""
      },
      {
        "statement": "E-mail",
        "type": "e-mail",
        "answer": ""
      },
      {
        "statement": "Otros datos (pagina web, blogs, Facebook, skype, etc)",
        "type": "textarea",
        "answer": ""
      },
      {
        "statement": "Distrito donde vive",
        "type": "text",
        "answer": ""
      },
      {
        "statement": "Colegio de Procedencia",
        "type": "text",
        "answer": ""
      },
      {
        "statement": "Academia Pre-Universitaria",
        "type": "text",
        "answer": ""
      },
      {
        "statement": "Orden de Mérito de Ingreso a la UNI",
        "type": "text",
        "answer": ""
      },
      {
        "statement": "Promedio ponderado acumulado",
        "type": "text",
        "answer": ""
      }
    ]
  },
  {
    "section": "OPINION SOBRE CURSOS Y PROFESORES",
    "questions": [
      {
        "statement": "Indique los tres mejores cursos que hasta ahora haya llevado en la UNI-FIIS (incluya el profesor q lo dictó)",
        "type": "table",
        "files": [
          {
            "columns": [
              {
                "value": "Nro.",
                "editable": false,
                "answer": ""
              },
              {
                "value": "Curso",
                "editable": false,
                "answer": ""
              },
              {
                "value": "Profesor",
                "editable": false,
                "answer": ""
              }
            ]
          },
          {
            "columns": [
              {
                "value": "1",
                "editable": false,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              }
            ]
          },
          {
            "columns": [
              {
                "value": "2",
                "editable": false,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              }
            ]
          },
          {
            "columns": [
              {
                "value": "3",
                "editable": false,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              }
            ]
          }
        ]
      },
      {
        "statement": "Indique cuatro principales cualidades que en su opinión debe poseer un buen profesor (sustente brevemente por qué)",
        "type": "table",
        "files": [
          {
            "columns": [
              {
                "value": "Nro.",
                "editable": false,
                "answer": ""
              },
              {
                "value": "Cualidad",
                "editable": false,
                "answer": ""
              },
              {
                "value": "Sustento",
                "editable": false,
                "answer": ""
              }
            ]
          },
          {
            "columns": [
              {
                "value": "1",
                "editable": false,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              }
            ]
          },
          {
            "columns": [
              {
                "value": "2",
                "editable": false,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              }
            ]
          },
          {
            "columns": [
              {
                "value": "3",
                "editable": false,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              }
            ]
          },
          {
            "columns": [
              {
                "value": "4",
                "editable": false,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              }
            ]
          }
        ]
      },
      {
        "statement": "¿Qué expectativas tiene del curso?",
        "type": "textarea",
        "answer": ""
      }
    ]
  },
  {
    "section": "FORMACIÓN EXTRA-ACADEMICA",
    "questions": [
      {
        "statement": "Nivel de Inglés",
        "type": "select",
        "options": [
          {
            "text": "Elemental",
            "value": "Elemental"
          },
          {
            "text": "Básico",
            "value": "Básico"
          },
          {
            "text": "Intermedio",
            "value": "Intermedio"
          },
          {
            "text": "Avanzado",
            "value": "Avanzado"
          }
        ],
        "answer": ""
      },
      {
        "statement": "Actividades Extra-académicas",
        "type": "table",
        "files": [
          {
            "columns": [
              {
                "value": "Actividad",
                "editable": false,
                "answer": ""
              },
              {
                "value": "Descripción",
                "editable": false,
                "answer": ""
              },
              {
                "value": "Lugar",
                "editable": false,
                "answer": ""
              },
              {
                "value": "Fecha Inicio",
                "editable": false,
                "answer": ""
              },
              {
                "value": "Fecha Fin",
                "editable": false,
                "answer": ""
              }
            ]
          },
          {
            "columns": [
              {
                "value": "Prácticas",
                "editable": false,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              }
            ]
          },
          {
            "columns": [
              {
                "value": "Ayudantía",
                "editable": false,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              }
            ]
          },
          {
            "columns": [
              {
                "value": "Maratones/Concursos de Programación (Hackathon, IEEEXtreme Programming, etc)",
                "editable": false,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              }
            ]
          },
          {
            "columns": [
              {
                "value": "Otros (Centros Culturales,etc)",
                "editable": false,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              }
            ]
          }
        ]

      }
    ]
  },
  {
    "section":"CONOCIMIENTO Y USO DE HERRAMIENTAS",
    "questions":[
      {
        "statement": "Conocimiento de Herramientas",
        "type": "multiquestion",
        "questions":[
          {
            "statement": "Lenguajes de Programación (Ejemplo: Java, PHP, etc). Autocalifique su nivel",
            "type":"table",
            "files":[
              {
                "columns": [
                  {
                    "value": "Lenguaje de Programación",
                    "editable": false,
                    "answer": ""
                  },
                  {
                    "value": "Auto calificación (escala de 0 a 20)",
                    "editable": false,
                    "answer": ""
                  }
                ]
              },
            {
              "columns": [
                {
                  "value": "Java",
                  "editable": false,
                  "answer": ""
                },
                {
                  "value": "",
                  "editable": true,
                  "answer": ""
                }
              ]
            },
            {
              "columns": [
                {
                  "value": "PHP",
                  "editable": false,
                  "answer": ""
                },
                {
                  "value": "",
                  "editable": true,
                  "answer": ""
                }
              ]
            },
            {
              "columns": [
                {
                  "value": "Python",
                  "editable": false,
                  "answer": ""
                },
                {
                  "value": "",
                  "editable": true,
                  "answer": ""
                }
              ]
            },
            {
              "columns": [
                {
                  "value": "Otros",
                  "editable": true,
                  "answer": ""
                },
                {
                  "value": "",
                  "editable": true,
                  "answer": ""
                }
              ]
            },
            {
              "columns": [
                {
                  "value": "Otros",
                  "editable": true,
                  "answer": ""
                },
                {
                  "value": "",
                  "editable": true,
                  "answer": ""
                }
              ]
            }
          ]
          },
          {
            "statement": "Gestores de Base de Datos (Ejem: Oracle, MySQL, etc).Autocalifique su nivel.",
            "type":"table",
            "files":[
              {
                "columns": [
                  {
                    "value": "Gestor de Base de Datos",
                    "editable": false,
                    "answer": ""
                  },
                  {
                    "value": "Auto calificación (escala de 0 a 20)",
                    "editable": false,
                    "answer": ""
                  }
                ]
              },
              {
                "columns": [
                  {
                    "value": "MySql",
                    "editable": false,
                    "answer": ""
                  },
                  {
                    "value": "",
                    "editable": true,
                    "answer": ""
                  }
                ]
              },
              {
                "columns": [
                  {
                    "value": "Oracle",
                    "editable": false,
                    "answer": ""
                  },
                  {
                    "value": "",
                    "editable": true,
                    "answer": ""
                  }
                ]
              },
              {
                "columns": [
                  {
                    "value": "Informix",
                    "editable": false,
                    "answer": ""
                  },
                  {
                    "value": "",
                    "editable": true,
                    "answer": ""
                  }
                ]
              },
              {
                "columns": [
                  {
                    "value": "Otros",
                    "editable": true,
                    "answer": ""
                  },
                  {
                    "value": "",
                    "editable": true,
                    "answer": ""
                  }
                ]
              },
              {
                "columns": [
                  {
                    "value": "Otros",
                    "editable": true,
                    "answer": ""
                  },
                  {
                    "value": "",
                    "editable": true,
                    "answer": ""
                  }
                ]
              }
            ]
          }
        ]
      },
      {
        "statement": "Lenguajes de Programación (Ejemplo: Java, PHP, etc). Autocalifique su nivel",
        "type":"table",
        "files":[
          {
            "columns": [
              {
                "value": "Sistema Informático o Prototipo",
                "editable": false,
                "answer": ""
              },
              {
                "value": "Breve descripción de la funcionalidad",
                "editable": false,
                "answer": ""
              },
              {
                "value": "Herramienta de programación utilizada (Java, PHP, etc.)",
                "editable": false,
                "answer": ""
              },
              {
                "value": "Gestor de Base de Datos (MySql, Oracle, etc.)",
                "editable": false,
                "answer": ""
              },
              {
                "value": "Fines: académicos o extra-académicos",
                "editable": false,
                "answer": ""
              }
            ]
          },
          {
            "columns": [
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              }
            ]
          },
          {
            "columns": [
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              }
            ]
          },
          {
            "columns": [
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              },
              {
                "value": "",
                "editable": true,
                "answer": ""
              }
            ]
          }
        ]
      }
    ]
  }
]' function-form="show">

  </vue-questionnaire>
@endsection
@push('js')
  {{-- <script src="{{asset('js/pages/admin.js')}}" charset="utf-8"></script> --}}
  <script src="{{asset('js/pages/guest.js')}}" charset="utf-8"></script>
@endpush
