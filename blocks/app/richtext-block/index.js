import block_icons from "../icons";

const { registerBlockType } = wp.blocks;
const { RichText } = wp.editor;
const { __ } = wp.i18n;

registerBlockType("test/rich-text", {
  title: __("Rich Text Example", "recipe"),
  description: __("Rich Text Example", "recipe"),
  category: "common",
  icon: block_icons.wapuu,
  attributes: {
    message: {
      type: "array",
      source: "children",
      selector: ".message-ctr",
    },
  },
  edit: (props) => {
    return (
      <div className={props.className}>
        <h3>Rich Text Example Block</h3>
        <RichText
          tagName="div"
          multiline="p"
          placeholder={__("Add your content here", "recipe")}
          onChange={(new_val) => {
            props.setAttributes({ message: new_val });
          }}
          value={props.attributes.message}
        ></RichText>
      </div>
    );
  },
  save: (props) => {
    return (
      <div>
        <h3>Rich Text Example Block</h3>
        <div className="message-ctr">{props.attributes.message}</div>
      </div>
    );
  },
});
